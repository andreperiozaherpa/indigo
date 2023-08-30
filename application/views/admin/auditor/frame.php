<!-- <base href="https://e-office.sumedangkab.go.id" target="_parent"> -->
<iframe id="frame" src="https://e-office.sumedangkab.go.id/auditor/frame/<?= $content_frame ?>" frameborder="0"
    gesture="media" allow="encrypted-media" allowtransparency="true" allowfullscreen="true"
    style="width: 100%; min-height: 720px; height: max-content;"></iframe>

<script type="text/javascript">
document.getElementById("frame").onload = function() {
    var hwindow = $(window).height() + 200;
    var hframe = document.getElementById("frame").contentWindow.document.body.scrollHeight + 200;
    document.getElementById("frame").style.height = (hwindow > hframe) ? hwindow + 'px' : hframe + 'px';
}
</script>