<?php
include "header.php";
?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">User Registration</h3>
            <div class="row">
                <div class="col-md-8">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">

                            <form action="<?= base_url('register') ?>" method="post">
                            

                            <div class="form-group row">

                                <div class="col-md-6">                                
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" value="">
                                </div>

                                <div class="col-md-6">                                
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"></label>
                                <input type="email" class="form-control"
                                       name="email" aria-describedby="emailHelp" placeholder="" value="">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                            <!-- <div class="form-group">
                                <label for="username"><?=lang('Auth.username')?></label>
                                <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                            </div> -->

                            <div class="form-group">
                                <label for="password"><?=lang('Auth.password')?></label>
                                <input type="password" name="password" class="form-control" placeholder="" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="pass_confirm"></label>
                                <input type="password" name="pass_confirm" class="form-control" placeholder="" autocomplete="off">
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary"></button>
                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Users List</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                             <thead>
                                <tr>
                                   <th>S.No</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Created At</th>
                                   <th>Operation</th>
                                </tr>
                             </thead>
                             <tbody>
                                <?php if($usersList): $i = 1;?>
                                <?php foreach($usersList as $row):?>
                                <tr>
                                   <td><?php echo $i++; ?></td>
                                   <td><?php echo $row->firstName. ' ' .$row->lastName; ?></td>
                                   <td><?php echo $row->email; ?></td>
                                   <td><?php echo date('d-m-Y H:i a', strtotime($row->created_at)); ?></td>
                                   <td></td>
                                </tr>
                               <?php endforeach; ?>
                               <?php endif; ?>
                             </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="row">
                                  <?php if ($pager) :?>
                                  <?php $pagi_path='admin/register'; ?>
                                  <?php $pager->setPath($pagi_path); ?>
                                  <?= $pager->links() ?>
                                  <?php endif ?>
                                 </div> 
                              </div>
                            </div>
                            </table>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>     
        </div>   
    </div>
    <!-- END MAIN CONTENT -->
</div>

