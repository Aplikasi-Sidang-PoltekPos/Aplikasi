<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">List Kegiatan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table" id="data-kegiatan">
                
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- /.card -->
</div>

<div class="modal fade" id="modal-pilih-kegiatan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                Detail Proyek
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="form-pilih-kegiatan">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class ="col-md-12">
                        <div class="form-group">
                            <label >Judul Proyek</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Proyek" name="judul_proyek">
                        </div>
                            </div>
                            
                            <div class ="col-md-9">
                                <div class="form-group">     
                            <label>Keyword</label>
                            <input type="text" class="form-control"   placeholder="Abstrak" name="keyword_abstrak"></textarea>
                        </div>
                                </div>
                                    </div>
                            
                            <div class ="col-md-6">
                        <div class="form-group">     
                            <label>Abstrak</label>
                            <textarea class="form-control" rows="5"  placeholder="Abstrak" name="abstrak"></textarea>
                        </div>
                             </div>
                            </div>
                        <div class="form-group">
                            <label>Latar Belakang</label>
                            <textarea class="form-control" placeholder="Latar Belakang" name="latar_belakang"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Identifikasi Masalah</label>
                            <textarea class="form-control" placeholder="Identifikasi Masalah" name="identifikasi_masalah"></textarea readonly>
                        </div>
                        <div class="form-group">
                            <label>Daftar Pustaka</label>
                            <textarea class="form-control" placeholder="Daftar Pustaka" name="daftar_pustaka"></textarea>
                        </div>
                        <div class="row">
                        <div class="form-group">     
                            <label>Kategori Proyek</label>
                            <input type="text" class="form-control"   placeholder="Abstrak" name="kategori_proyek" placeholder="ex:IoT, SCM, Data Mining"></textarea>
                        </div>
                        <div class="col-md-2">
                            </div>
                            <div class="col-md-4">
                        <div class="form-group">
                            <label>Anggota</label>
                            <select class="form-control select2" style="width:100%;" name="npm_anggota" id="npm_anggota">
                                <option selected disabled>Pilih</option>
                            </select>
                        </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>              
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="save-pilih-kegiatan" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
      