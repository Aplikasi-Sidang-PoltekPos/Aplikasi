<div class="row">
    <div class="col-md-6">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2>Kontrak Proyek</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Kegiatan</label><br>
                    <p id="nama_kegiatan" >Kegiatan</p>
                </div>
                <div class="form-group">
                    <label >Koordinator</label>
                    <p id="nama_koordinator">Koordinator</p>
                </div>
                <div class="form-group">
                    <label >Dosen Pembimbing</label>
                    <p id="nama_dosen_pembimbing">Dosen Pembimbing</p>
                </div>
                <div class="form-group">
                    <label>Status Proyek</label><br>
                    <p id="status_proyek">Status</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">Status Sidang</div>
            <div class="card-body">
                <div class="form-group">
                    <label >Tanggal Sidang</label>
                    <p id="tgl_sidang">Tanggal Sidang</p>
                </div>
                <div class="form-group">
                    <label>Ruangan</label>
                    <p id="ruangan">Ruangan</p>
                </div>
                <div class="form-group">
                    <label >Dosen Penguji</label>
                    <p id="id_dosen_penguji">Dosen Penguji</p>
                </div>
                <div class="form-group">
                    <label >Nilai</label>
                    <p>Nilai</p>
                </div>
                <div class="form-group">
                    <label >Status Nilai</label>
                    <p>Status Nilai</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card">
        <div class="card-header">
        <div class="row">
            <h5 style="font-size:30px">Detail Proposal</h5>
        </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label >Judul Proyek</label>
                <textarea rows="3" style ="border:none" class="form-control" id="judul_proyek" placeholder="Judul Proyek" readonly>
            </div>
            <div class="form-group">     
                <label>Abstrak</label>
                <textarea class="form-control" style ="border:none" rows="3" id="abstrak" placeholder="Abstrak" readonly></textarea>
            </div>      
            <div class="form-group">
                <label>Latar Belakang</label>
                <textarea class="form-control" style ="border:none" rows="3" id="latar_belakang" placeholder="Latar Belakang" readonly></textarea>
            </div>
            <div class="form-group">
                <label>Identifikasi Masalah</label>
                <textarea class="form-control" style ="border:none" rows="3" id="identifikasi_masalah" placeholder="Identifikasi Masalah" readonly></textarea readonly>
            </div>
            <div class="form-group">
                <label>Daftar Pustaka</label>
                <textarea class="form-control" style ="border:none" rows="3" id="daftar_pustaka" placeholder="Daftar Pustaka" readonly></textarea>
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
               
            <div class="col-md-3">
            <div class="form-group">
            <button id="lengkapi"  type="button" class="btn btn-block btn-success"> Edit</button>
            </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="modal-pilih-anggota">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pengajuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-ajukan-anggota">
                <div class="card-body">
                    <div class="form-group">
                        <label>Anggota</label>
                        <select class="form-control select2" style="width:100%;" name="npm_anggota" id="npm_anggota">
                            <option selected disabled>Pilih</option>
                        </select>
                    </div>
                </div>
              </form>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button id="save" type="button" class="btn btn-primary">Ajukan</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>