<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuth(2);

        $this->load->model('m_pendaftaran');
    }

    public function index()
    {
        $data['title'] = "Jadawl Pendaftaran";
        $data['jadwal'] = $this->m_pendaftaran->getJadwal();
        $data['jalur'] = $this->m_pendaftaran->getJalur();

        getViews($data, 'v_admin/v_jadwal_daftar');
    }

    public function tambah()
    {
        $data['title'] = "Tambah Jadawal Pendaftaran";
        $data['jalur'] = $this->m_pendaftaran->getJalur();

        $this->form_validation->set_rules('nama', 'Kegiatan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jalur', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required|trim|callback_cekTglMulai', ['required' => '{field} tidak boleh kosong', 'cekTglMulai' => '{field} tidak boleh lebih dari Tanggal Berakhir ']);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required|trim|callback_cekTglAkhir', ['required' => '{field} tidak boleh kosong', 'cekTglAkhir' => '{field} tidak boleh kurang dari Tanggal Mulai']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_jadwal_daftar');
        } else {
            //formating date to same as database formating :)
            $tgl_mulai = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_mulai'))->format('Y-m-d');
            $tgl_akhir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');

            $data = [
                'id_jalur_pendaftaran' => $this->input->post('jalur'),
                'nama_jadwal' => strtolower($this->input->post('nama', true)),
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_akhir
            ];


            if (insertData('jadwal_pendaftaran', $data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                redirect('admin/pendaftaran/jadwal');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                redirect('admin/pendaftaran/jadwal');
            }
        }
    }

    public function update(){
        if (isset($_POST['id_jadwal_update'])) {
            $id_jadwal = $_POST['id_jadwal_update'];

            $data = $this->db->get_where('jadwal_pendaftaran', ['id_jadwal_pendaftaran' => $id_jadwal])->row_array();

            $data_jadwal = [
                'id_jadwal' => $data['id_jadwal_pendaftaran'],
                'id_jalur' => $data['id_jalur_pendaftaran'],
                'nama_jadwal' => $data['nama_jadwal'],
                'tgl_mulai' => DateTime::createFromFormat('Y-m-d', $data['tgl_mulai'])->format('m/d/Y'),
                'tgl_selesai' => DateTime::createFromFormat('Y-m-d', $data['tgl_selesai'])->format('m/d/Y')
            ];

            echo json_encode($data_jadwal);
        }elseif(isset($_POST['simpan'])){
            $this->form_validation->set_rules('nama', 'Kegiatan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('jalur', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required|trim|callback_cekTglMulai', ['required' => '{field} tidak boleh kosong', 'cekTglMulai' => '{field} tidak boleh lebih dari Tanggal Berakhir ']);
            $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required|trim|callback_cekTglAkhir', ['required' => '{field} tidak boleh kosong', 'cekTglAkhir' => '{field} tidak boleh kurang dari Tanggal Mulai']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('admin/pendaftaran/jadwal');
            } else {
                $id_jadwal = $this->input->post('id_jadwal');
                //formating date to same as database formating :)
                $tgl_mulai = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_mulai'))->format('Y-m-d');
                $tgl_akhir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');

                $data = [
                    'id_jalur_pendaftaran' => $this->input->post('jalur'),
                    'nama_jadwal' => strtolower($this->input->post('nama', true)),
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_selesai' => $tgl_akhir
                ];


                if (updateData('jadwal_pendaftaran', $data, 'id_jadwal_pendaftaran', $id_jadwal)) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                    redirect('admin/pendaftaran/jadwal');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                    redirect('admin/pendaftaran/jadwal');
                }
            }
        }
    }

    public function delete($id)
    {
       // $delete = $this->db->delete('jadwal_pendaftaran', ['id_jadwal_pendaftaran' => $id]);

        if (deleteData('jadwal_pendaftaran', 'id_jadwal_pendaftaran', $id)) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil dihapus');

            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal dihapus');

            http_response_code(404);
        }
    }

    public function cekTglAkhir($str)
    {
        $tgl_mulai = $this->input->post('tgl_mulai');

        if ($str < $tgl_mulai) {
            return false;
        } else {
            return true;
        }
    }

    public function cekTglMulai($str)
    {
        $tgl_akhir = $this->input->post('tgl_akhir');

        if ($str > $tgl_akhir) {
            return false;
        } else {
            return true;
        }
    }
}
