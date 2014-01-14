<p class="lead text-danger">
    Sorry!
</p>
<p class="text-danger">
    <?php
        foreach($message as $apology)
        {
            printf(htmlspecialchars($apology));
            printf("<br/>");
        }
    ?>
</p>

<a href="javascript:history.go(-1);">Back</a>
