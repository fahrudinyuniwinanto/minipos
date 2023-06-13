<!doctype html>
<html>

    <head>
        <title></title>
    </head>

    <body>
        <div class="row" style="height: 100%">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2 style="margin-top:0px">Ganti Password </h2>
                    </div>

                    <form action="<?php echo $action; ?>" method="post">
                        <div class="ibox-content">
                            <?php if ($this->session->flashdata('message') != ""): ?>
                            <div class="alert alert-warning">
                                <?=$this->session->flashdata('message')?></div>
                            <?php endif?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="varchar">Fullname</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                            placeholder="Fullname" value="<?php echo $users->fullname; ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="varchar">Username <?php echo form_error('username') ?></label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Username" value="<?php echo $users->username; ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="varchar">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" value="<?php echo $users->email; ?>" readonly />
                                    </div>

                                    <input type="hidden" name="id_user" value="<?php echo $users->id_user; ?>" />
                                    <button type="submit" class="btn btn-primary">Ganti</button>
                                    <a href="<?php echo site_url('backend') ?>" class="btn btn-default">Cancel</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="varchar">Password Lama</label>
                                        <input type="password" class="form-control" name="password_lama"
                                            id="password_lama" placeholder="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="varchar">Password Baru</label>
                                        <input type="password" class="form-control" name="password_baru"
                                            id="password_baru" placeholder="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="varchar">Ulangi Password Baru</label>
                                        <input type="password" class="form-control" name="ulangi_password_baru"
                                            id="ulangi_password_baru" placeholder="" />
                                    </div>
                                    <div class="form-group hide">
                                        <label for="int">Updated By <?php echo form_error('updated_by') ?></label>
                                        <input type="text" class="form-control" name="updated_by" id="updated_by"
                                            placeholder="Updated By" value="<?php echo $users->updated_by; ?>"
                                            readonly />
                                    </div>
                                    <div class="form-group hide">
                                        <label for="datetime">Updated At <?php echo form_error('updated_at') ?></label>
                                        <input type="text" class="form-control" name="updated_at" id="updated_at"
                                            placeholder="Updated At" value="<?php echo $users->updated_at; ?>"
                                            readonly />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
