        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- PAGE TITLE -->                    
                    <div class="page-title">                    
                        <h2><span class="fa fa-user"></span> Dashboard</h2>
                    </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">

                    <div class="col-md-3">
                            <!-- START WIDGET EMPRESAS CADASTRADAS -->
                            <div class="widget widget-warning widget-item-icon" onclick="location.href='pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-list-alt"></span>
                                </div>                             

                                <div class="widget-data">
                                    <div class="widget-int num-count"><?=$n_usu->count?></div>
                                    <div class="widget-title">Usuários</div>
                                    <div class="widget-subtitle">Cadastrados</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET EMPRESAS CADASTRADAS -->
                        </div>


                        <div class="col-md-3">
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-success widget-item-icon" onclick="location.href='pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-list-alt"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?=$n_emp->count?></div>
                                    <div class="widget-title">Empresas</div>
                                    <div class="widget-subtitle">Cadastradas</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                        </div>

                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-danger widget-item-icon" onclick="location.href='pages-address-book.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-list-alt"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?=$n_adm->count?></div>
                                    <div class="widget-title">Administadores</div>
                                    <div class="widget-subtitle">Cadastrados</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-primary widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href=""><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href=""><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href=""><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                    </div>
                    <!-- END WIDGETS -->                    
                    
                    <div class="row">          
                    </div>
                    
                    <div class="row">
                    </div>  
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->



