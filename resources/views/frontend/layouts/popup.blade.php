<div class="popup-badan" style="display:none;width: 650px;">
    <div class="popup-body popupEdit"  id="pencarianLanjut">
        <div class="register-body">
            <div class="top-text text-center"><p>Pencarian Lanjutan SIJAMAS</p></div>
            <div class="inputnya">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <!--<div class="form-group">-->
                            <!--  <label>Jenis Pencarian</label>-->
                            <!--  <select class="form-control">-->
                            <!--    <option> -- Pilih Jenis Pencarian -- </option>-->
                            <!--    <option>Pencarian Berita</option>-->
                            <!--    <option>Pencarian Olahraga</option>-->
                            <!--  </select>-->
                            <!--</div>-->
                            <div class="form-group">
                              <label>Periode Pencarian</label>
                              <div class="row">
                                  <div class="col-md-12">
                                      <select class="form-control">
                                        <option> -- Pilih Jenis Periode -- </option>
                                        <option>Tanggal Terbaru</option>
                                      </select>
                                  </div>
                                  <div class="col-md-5 col-sm-5 col-xs-6">
                                      <div class="inner-addon right-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <input type="text" class="form-control datepicker1"/>
                                      </div>
                                  </div>
                                  <div class="col-md-2 hidden-xs text-center">
                                    <span>Sampai</span>
                                  </div>
                                  <div class="col-md-5 col-sm-5 col-xs-6">
                                     <div class="inner-addon right-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <input type="text" class="form-control datepicker2  "/>
                                      </div>
                                  </div>
                              </div>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Kategori Kerjasama</label>
                              <select class="form-control">
                                <option> -- Pilih Kategori Kerjasama -- </option>
                                <option>Kerjasama Luar Negeri</option>
                                <option>Kerjasama Dalam Negeri</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Jenis Kerjasama</label>
                              <select class="form-control">
                                <option> -- Pilih Jenis Kerjasama -- </option>
                                <option>Payung Kerjasama</option>
                                <option>Perjanjian Pelaksana</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Status Kerjasama</label>
                              <select class="form-control">
                                <option> -- Pilih Status Kerjasama -- </option>
                                <option>Baru</option>
                                <option>Lanjutan</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Bidang Fokus</label>
                              <select class="form-control">
                                <option> -- Pilih Bidang Fokus -- </option>
                                <option>Teknologi Informasi</option>
                                <option>Pendidikan</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Tahun Penandatanganan</label>
                              <select class="form-control">
                                <option> -- Pilih Tahun -- </option>
                                <option>2011</option>
                                <option>2012</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Tahun Berakhir</label>
                              <select class="form-control">
                                <option> -- Pilih Tahun -- </option>
                                <option>2017</option>
                                <option>2018</option>
                              </select>
                            </div><!--end.form-group-->
                            <div class="form-group">
                              <label>Pencarian Global</label>
                              <input type="text" class="form-control" placeholder="masukan kata pencarian">
                            </div>
                            <div class="rows">
                              <button type="submit" class="btn btn-primary">Tampilkan</button>
                              <button type="submit" class="btn btn-default">Reset</button>
                              <button type="submit" class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </div><!--end.row-->
                </form>
            </div><!--end.inputnya-->
        </div><!--end.register-body-->
    </div><!--end.popup-body-->
</div><!--end.popup-container-->

<div class="popup-badan" style="display:none;width: 650px;">
    <div class="popup-body popupEdit"  id="login">
        <div class="register-body">
            <div class="top-text text-center"><p>LOGIN SIJAMAS</p></div>
            <div class="inputnya">
                <form>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group label-floating ">
                              <label class="control-label">Username</label>
                              <input type="text" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label">Password</label>
                              <input type="password" class="form-control">
                            </div>
                            <div class="rows">
                              <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                              <a href="#forgot" class="forget popup">Lupa Password ?</a>
                            </div>
                        </div>
                    </div><!--end.row-->
                </form>
            </div><!--end.inputnya-->
        </div><!--end.register-body-->
    </div><!--end.popup-body-->
</div><!--end.popup-container-->

<div class="popup-badan" style="display:none;width: 650px;">
    <div class="popup-body popupEdit"  id="forgot">
        <div class="register-body">
            <div class="top-text text-center"><p>Lupa Password</p></div>
            <div class="inputnya">
                <form>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <p>Silahkan masukan alamat email anda dan kami akan mengirimkan link untuk reset password</p>
                            <div class="form-group label-floating ">
                              <label class="control-label">Email</label>
                              <input type="email" class="form-control">
                            </div>
                            <div class="rows">
                              <a href="#confirm" class="btn btn-primary btn-block popup">Submit</a>
                            </div>
                        </div>
                    </div><!--end.row-->
                </form>
            </div><!--end.inputnya-->
        </div><!--end.register-body-->
    </div><!--end.popup-body-->
</div><!--end.popup-container-->

<div class="popup-badan" style="display:none;width: 650px;">
    <div class="popup-body popupEdit"  id="confirm">
        <div class="register-body text-center">
            <h4>Data Terkirim</h4>
            <p>Silahkan Cek email  anda untuk instruksi selanjutnya</p>
        </div><!--end.register-body-->
    </div><!--end.popup-body-->
</div><!--end.popup-container-->
<script type="text/javascript">

</script>


