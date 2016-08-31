<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/19/16
 * Time: 8:11 PM
 */
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <br>
        </div>
    </form>
    <ul class="nav menu">
        <li class="<?php echo $basic == 'home'? 'active':''; ?>"><a href="<?php echo base_url(); ?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li  class="<?php echo $basic == 'verifications'? 'active':''; ?> "><a href="<?php echo base_url().'index.php/site/verifications/' ?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Verifications</a></li>
        <li  class="<?php echo $basic == 'facilities'? 'active':''; ?>"><a href="<?php echo base_url().'index.php/site/institutions/' ?>"><svg class="glyph stroked location pin"><use xlink:href="#stroked-location-pin"/></svg>Facilities</a></li>
        <li   class="parent <?php echo $basic == 'personnel_management'? 'active':''; ?>">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Personnel
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="<?php echo base_url().'index.php/site/manage_personnel' ?>">
                        <svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Personnel Management
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo base_url().'index.php/site/personnel_reports' ?>">
                        <svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Reports
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent <?php echo $basic == 'settings'? 'active':''; ?>"><a href="<?php echo base_url().'index.php/site/settings' ?>"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"/></svg>Settings</a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="<?php echo base_url().'index.php/auth/login' ?>"><svg class="glyph stroked lock"><use xlink:href="#stroked-lock"/></svg>LogOut</a></li>
    </ul>

</div><!--/.sidebar-->

