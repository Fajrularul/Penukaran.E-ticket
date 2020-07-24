<?php $base_url = $this->Url->build('/', true); ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php 
                $session = $this->request->session();
                $user = $session->read('loggedUser');
            ?>
            
            <div class="row">
            <?php
                if($user['role'] == 'admin')
                {
            ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red" style="border-color: #d9534f !important;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="huge">Ticket<br/>Log</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= $base_url; ?>dashboard/logs/">
                                <div class="panel-footer">
                                    <span class="pull-left">Go &gt;</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow" style="border-color: #f0ad4e !important;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="huge">Ticket Report</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= $base_url; ?>dashboard/report/">
                                <div class="panel-footer">
                                    <span class="pull-left">Go &gt;</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php 
                }
                if($user['role'] == 'operator' || $user['role'] == 'admin')
                {
                ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green" style="border-color: #5cb85c !important;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="huge">Ticket Finder</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= $base_url; ?>dashboard/search/">
                                <div class="panel-footer">
                                    <span class="pull-left">Go &gt;</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php 
                }
                if($user['role'] == 'operator')
                {
                ?>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="huge">Ticket Checker</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= $base_url; ?>dashboard/check/">
                                <div class="panel-footer">
                                    <span class="pull-left">Go &gt;</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php 
                    }
                    if($user['role'] == 'owner')
                    {
                ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow" style="border-color: #f0ad4e !important;">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge">Ticket Report</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= $base_url; ?>dashboard/report/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Go &gt;</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
						

                 
					
					 }
                    if($user['role'] == 'sales')
                    {
                ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow" style="border-color: #f0ad4e !important;">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge">Sales</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= $base_url; ?>dashboard/sales/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Go &gt;</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
					?>
                
            </div>
			<?php
