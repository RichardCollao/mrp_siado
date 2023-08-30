<div style="display: inline-block; width: auto; vertical-align : bottom;">
    <div style="float: left; padding: 6px 12px;margin: 0;">
        Pagina&nbsp;<?php echo $data['current_page']; ?>&nbsp;de&nbsp;<?php echo $data['total_pages']; ?>
    </div>
    <ul class="pagination" style="margin:0; float: left">
        <?php if (isset($data['first'])): ?>
            <li><a href="<?php echo $data['first'];?>">Primera</a></li>
        <?php endif; ?>
        <?php if (isset($data['back'])): ?>
            <li><a href="<?php echo $data['back'];?>"><</a></li>
        <?php endif; ?>
        <?php foreach ($data['links'] as $key => $link): ?>
            <?php if ($key == $data['current_page']): ?>
                <li class="active"><a href="<?php echo $link;?>"><?php echo $key; ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo $link;?>"><?php echo $key; ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>            
        <?php if (isset($data['next'])): ?>
            <li><a href="<?php echo $data['next'];?>">></a></li>
        <?php endif; ?>
        <?php if (isset($data['last'])): ?>
            <li><a href="<?php echo $data['last'];?>">Ultima</a></li>
        <?php endif; ?>
    </ul>
    <div style="clear: both"></div>
</div>