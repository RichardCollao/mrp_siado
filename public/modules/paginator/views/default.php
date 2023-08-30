<?php Header::styleCssStart(); ?>
<style type="text/css">
    .paginator{
        border-collapse:separate;
        border-spacing:2px;
        height:22px;
        border:1px solid silver; 
        float:right; 
        font-size:12px;
    }

    .paginator_current{
        border:1px solid gray;
    }

    .paginator tr td {
        background: white;
        width:20px;
        text-align:center;
        white-space:nowrap; 
    }
</style>
<?php Header::styleCssEnd(); ?>

<table class="paginator">
    <tr>
        <td style="background:inherit;">&nbsp;Pagina&nbsp;<?php echo $data['current_page']; ?>&nbsp;de&nbsp;<?php echo $data['total_pages']; ?>&nbsp;&nbsp;</td>
        <?php if (isset($data['first'])): ?>
            <td style="width:50px;"><a href="<?php echo $data['first']; ?>">Primera</a></td>
        <?php endif; ?>

        <?php if (isset($data['back'])): ?>
            <td><a href="<?php echo $data['back']; ?>" title="Retroceder">&lt;</a></td>
<?php endif; ?>

        <?php foreach ($data['links'] as $key => $link): ?>
            <?php if ($key == $data['current_page']): ?>
                <td <?php echo 'class="paginator_current"'; ?>><b><?php echo $key; ?></b></td>
            <?php else: ?>
                <td><a href="<?php echo $link; ?>"><?php echo $key; ?></a></td>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (isset($data['next'])): ?>
            <td><a href="<?php echo $data['next']; ?>" title="Avanzar">&gt;</a></td>
        <?php endif; ?>

        <?php if (isset($data['last'])): ?>
            <td style="width:50px;"><a href="<?php echo $data['last']; ?>">Ultima</a></td>
        <?php endif; ?>
    </tr>
</table>