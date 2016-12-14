
<div id="modal-1" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <div class="List">
            <p align='right'>
                <input type="button" class="btn btn-primary" value="Add News" onclick="redir('/news/dsp_single_news');">
                <input type="button" class="btn btn-danger" value="Delete" onclick="onDelAll();">
            </p>
            <table border="0" class="table table-hover">
                <tr>
                    <th width="10">emp_id</th>
                    <th width="20">emp_email</th>
                    <th width="100">ten nguoi dang</th>
                    <th>Tieu de</th>
                    <th>anh</th>
                    <th>ngay dang</th>
                    <th colspan="2">Action</th>
                    <th><input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()"></th>
                </tr>
                <?php
                Session::init();
                $email = Session::get('email');
                $recordSet = $this->recordSet;
                if (!$recordSet) {
                    echo '<tr><td colspan="8">ko tim thay du lieu</td></tr> ';
                } else {
                    foreach ($recordSet as $item) {
                        ?>          
                        <tr>
                            <td><?php echo $item["emp_id"] ?></td>
                            <td><?php echo $item["emp_email"] ?></td>
                            <td><?php echo $item["emp_name"] ?></td>
                            <td><a href="<?php echo URL; ?>/news/dsp_content_news/<?php echo $item['news_id']; ?>"><?php echo $item["news_title"] ?></a></td>
                            <td><?php echo $item["news_img"] ?></td>
                            <td><?php ?></td>
                            <td><a href="javascript:void(0);" onclick="onDelOne('<?php echo $item["news_id"]; ?>', '<?php echo $item["news_title"] ?>', 'news');">Del</a></td>
                            <td><a href="">Edit</a></td>
                            <td><a href=""><input type="checkbox" name="ick[]" id="ick[]" value="<?php echo $item["emp_id"] ?>"></a></td>
                        </tr> 
        <?php
    }
}
?>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" data-dismiss="modal">Save changes</button>
    </div>
</div>
<div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" data-dismiss="modal">Save changes</button>
    </div>
</div>
<div id="modal-3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
        <button class="btn btn-primary" data-dismiss="modal">Yes</button>
    </div>
</div>
<div id="modal-4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal">Ok</button>
    </div>
</div>

<!-- end data -->

<div class="row-fluid">
    <div class="span6">
        <div class="box box-color box-bordered magenta">
            <div class="box-title">
                <h3>
                    <i class="icon-comment"></i>
                    Tooltips
                </h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content">
                <p>
                <h4>Tooltips</h4>
                <a href="#" class="btn" rel="tooltip" title="Default Tooltip">Default tooltip</a>
                <a href="#" class="btn" rel="tooltip" title="Right Tooltip" data-placement="right">Right tooltip</a>
                <a href="#" class="btn" rel="tooltip" title="Left Tooltip" data-placement="left">Left tooltip</a>
                <a href="#" class="btn" rel="tooltip" title="Bottom Tooltip" data-placement="bottom">Bottom tooltip</a>
                <a href="#" class="btn" rel="tooltip" title="Default Tooltip">Default tooltip</a>
                </p>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="span6">
        <div class="box box-color box-bordered lime">
            <div class="box-title">
                <h3>
                    <i class="icon-reorder"></i>
                    Modals
                </h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content">
                <p>
                <h4>Modals</h4>
                <a href="#modal-1" role="button" class="btn" data-toggle="modal">Basic modal</a>
                <a href="#modal-2" role="button" class="btn" data-toggle="modal">Modal with animation</a>
                <a href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
                <a href="#modal-3" role="button" class="btn" data-toggle="modal">Confirm</a>
                <a href="#modal-1" role="button" class='btn' data-toggle='modal'>Bassic modal</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- popover and warning -->

<div class="row-fluid">
    <div class="span6">
        <div class="box box-color box-bordered orange">
            <div class="box-title">
                <h3>
                    <i class="icon-comment-alt"></i>
                    popovers
                </h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content">
                <p>
                <h4>Popover</h4>
                <a href="#" class="btn" rel="popover" data-trigger="hover" title="Default popover" data-content="Lorem ipsum et dolor aute deserunt nisi do. Lorem ipsum irure aute officia id pariatur ex adipisicing deserunt velit consequat cupidatat adipisicing commodo. Lorem ipsum ad fugiat velit elit et non id. ">Default popover</a>
                <a href="#" class="btn" rel="popover" data-trigger="hover" title="Top popover" data-placement="top" data-content="Lorem ipsum et dolor aute deserunt nisi do. Lorem ipsum irure aute officia id pariatur ex adipisicing deserunt velit consequat cupidatat adipisicing commodo. Lorem ipsum ad fugiat velit elit et non id. ">Top popover</a>
                <a href="#" class="btn" rel="popover" data-trigger="hover" title="Left popover" data-placement="left" data-content="Lorem ipsum et dolor aute deserunt nisi do. Lorem ipsum irure aute officia id pariatur ex adipisicing deserunt velit consequat cupidatat adipisicing commodo. Lorem ipsum ad fugiat velit elit et non id. ">Left popover</a>
                <a href="#" class="btn" rel="popover" data-trigger="hover" title="Bottom popover" data-placement="bottom" data-content="Lorem ipsum et dolor aute deserunt nisi do. Lorem ipsum irure aute officia id pariatur ex adipisicing deserunt velit consequat cupidatat adipisicing commodo. Lorem ipsum ad fugiat velit elit et non id. ">Bottom popover</a>
                <a href="#" class="btn" rel="popover" title="Hover popover" data-placement="top" data-content="Lorem ipsum et dolor aute deserunt nisi do. Lorem ipsum irure aute officia id pariatur ex adipisicing deserunt velit consequat cupidatat adipisicing commodo. Lorem ipsum ad fugiat velit elit et non id. ">Click popover</a>
                </p>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="box box-color box-bordered red">
            <div class="box-title">
                <h3>
                    <i class="icon-bell"></i>
                    Notifications
                </h3>
                <div class="actions">
                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                </div>
            </div>
            <div class="box-content">
                <p>
                <h4>Notifications</h4>
                </p>
                <p><a href="#modal-1" role="button" class="btn notify" data-notify-title="Success!" data-notify-message="The user has been successfully edited.">Basic notification</a>
                    <a href="#modal-1" role="button" class="btn notify" data-notify-time="1000" data-notify-title="Success!" data-notify-message="The user has been successfully edited.">Timed fade notification (1second)</a>
                    <a href="#modal-1" role="button" class="btn notify" data-notify-title="WARNING!" data-notify-message="Please refresh the cache!" data-notify-sticky="true">Sticky notification</a>
            </div>
        </div>
    </div>
</div>
