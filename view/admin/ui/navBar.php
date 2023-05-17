<?php $current_url = $_SERVER['REQUEST_URI'];?>
<aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">BASIC ADMINISTRATION</li>
                    <li class="<?php 
                    if ($current_url == "/admin") {
                        echo 'active';
                    }
                    ?>">
                        <a href="/admin">
                            <i class="fa fa-home"></i> <span>Overview</span>
                        </a>
                    </li>
                    <li class="<?php 
                    if ($current_url == "/admin/settings" || $current_url == "/admin/settings/mail" || $current_url == "/admin/settings/advanced") {
                        echo 'active';
                    }
                    ?>">
                        <a href="/admin/settings">
                            <i class="fa fa-wrench"></i> <span>Settings</span>
                        </a>
                    </li>
                    <li class="<?php
                    if ($current_url == "/admin/api" || $current_url == "/admin/api/new") {
                        echo 'active';
                    }
                    ?>">
                        <a href="/admin/api">
                            <i class="fa fa-gamepad"></i> <span>Application API</span>
                        </a>
                    </li>
                    <li class="header">MANAGEMENT</li>
                    <li class="">
                        <a href="/admin/nodes">
                            <i class="fa fa-sitemap"></i> <span>Nodes (SOON)</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/admin/servers">
                            <i class="fa fa-server"></i> <span>Domains</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/admin/nests">
                            <i class="fa fa-th-large"></i> <span>Imagines</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/admin/users">
                            <i class="fa fa-users"></i> <span>Users</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>