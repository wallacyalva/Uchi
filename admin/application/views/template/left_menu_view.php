<div class="page-sidebar">
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="" style="background-color: #2d3945; color: #fff"></a>
            <a href="" style="background-color: #212a32" class="x-navigation-control"></a>
        </li>

        <li class="xn-profile">

            <a href="" class="profile-mini" id="profile_mini">
                <img src="<?=base_url()?>uploads/images/users/<?=$user->avatar?>">
            </a>

            <div class="profile">

                <div class="profile-image">
                    <img src="<?=base_url()?>uploads/images/users/<?=$user->avatar?>">
                </div>

                <div class="profile-data">
                    <div class="profile-data-name"><?=$user->nome?></div>
                    <div class="profile-data-title"></div>
                </div>

                <div class="profile-controls">
                    <a href="<?=base_url()?>usuario/profile" class="profile-control-left"><span class="fa fa-edit"></span></a>
                    <a href="<?=base_url()?>usuario" class="profile-control-right"><span class="fa fa-dashboard"></span></a>
                </div>

            </div>                                                                        
        </li>
                    
        <li class="xn-title">Navegação</li>

        <li class="xn-openable">
            <a href=""><span class="fa fa-dashboard"></span> <span class="xn-text">Painel</span></a>
            <ul>
                <li><a href="<?=base_url();?>usuario"><span class="fa fa-dashboard"></span>Dashboard</a></li>

                <li><a href="<?=base_url();?>usuario/profile"><span class="fa fa-edit"></span>Meus Dados</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href=""><span class="fa fa-users"></span> <span class="xn-text">Usuários</span></a>
            <ul>
                <li><a href="<?=base_url()?>usuario/listar"><span class="fa fa-list"></span> Listar</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href=""><span class="fa fa-building"></span> <span class="xn-text">Empresas</span></a>
            <ul>
                <li><a href="<?=base_url()?>empresa/listar"><span class="fa fa-list"></span> Listar</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href=""><span class="fa fa-user-secret"></span> <span class="xn-text">Administradores</span></a>
            <ul>
                <li><a href="<?=base_url()?>administrador/listar"><span class="fa fa-list"></span> Listar</a></li>
            </ul>
        </li>

        <li class="xn-openable">
            <a href=""><span class="fa fa-picture-o"></span> <span class="xn-text">Banners</span></a>
            <ul>
                <li><a href="<?=base_url("pagina/paginas");?>"><span class="fa fa-plus"></span> Novo</a></li>
                <li><a href="<?=base_url("pagina/paginas");?>"><span class="fa fa-eye"></span> Ver</a></li>
            </ul>
        </li>

        <li class="xn-openable">
        <a href=""><span class="fa fa-files-o"></span> <span class="xn-text">Formulários</span></a>
            <ul>
                <li><a href="<?=base_url()?>formulario/criarFormulario"><span class="fa fa-plus"></span> Criar</a></li>
                <li><a href="<?=base_url()?>formulario/listarFormulario"><span class="fa fa-list"></span> Listar</a></li>
            </ul>
        </li>

        <li class="xn-openable">
        <a href=""><span class="fa fa-book"></span> <span class="xn-text">Dados</span></a>
            <ul>
                <li><a href="<?=base_url()?>dados/areas"><span class="fa fa-th-list"></span> Areas</a></li>
                <li><a href="<?=base_url()?>dados/profissoes"><span class="fa fa-th-list"></span> profissões</a></li>
                <li><a href="<?=base_url()?>dados/formacoes"><span class="fa fa-th-list"></span> Formações</a></li>
                <li><a href="<?=base_url()?>dados/idiomas"><span class="fa fa-th-list"></span> Idiomas</a></li>
                <li><a href="<?=base_url()?>dados/bibliografias"><span class="fa fa-th-list"></span> Bibliografias</a></li>
                <li><a href="<?=base_url()?>dados/informatica"><span class="fa fa-th-list"></span> Infomaticas</a></li>
                <li><a href="<?=base_url()?>dados/premiacao"><span class="fa fa-th-list"></span> Premiações</a></li>
            </ul>
        </li>

        <li class="xn-openable">
        <a href=""><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Relatório</span></a>
            <ul>
                <li><a href="<?=base_url("relatorio/clientes");?>"><span class="fa fa-file-text"></span> Usuários</a></li>
                <li><a href="<?=base_url("relatorio/empreendedores");?>"><span class="fa fa-file-text"></span> Empresas</a></li>
            </ul>
        </li>

        <li style="margin-bottom: 25%"></li> <!-- NÃO TIRAR MOTIVO: precisa ter um ultimo li, sanão ele não coloca borda no ultimo item da lista!-->

    </ul>
</div>