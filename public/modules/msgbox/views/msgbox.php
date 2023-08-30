<script type="text/javascript">
    function closeMSG(obj) {
        $(obj).closest(".msg").remove();
    }
</script>

<div class="msg panel-<?php echo $data['event']; ?>" style="background-color: white; border:1px solid silver; margin-top:15px">
    <div class="panel-heading">
        <button type="button" class="close" title="Close" onclick="closeMSG(this);">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="panel-title">Aviso</h3>
    </div>    
    <div class="panel-body">
        <table>
            <tr>
                <td style="vertical-align:top; width:100px">
                    <div style="margin:5px;">
                        <img style="margin:5px; width:30px; height:30px;" src="<?php echo $data['icon']; ?>" alt="" title="" />
                    </div>
                </td>
                <td>
                    <div style="margin:5px;">
                        <?php echo $data['message']; ?>
                        <?php if (!is_empty($data['items'])): ?>
                            <ul>
                                <?php foreach ($data['items'] as $item): ?>
                                    <li><?php echo $item; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php echo $data['footer']; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>