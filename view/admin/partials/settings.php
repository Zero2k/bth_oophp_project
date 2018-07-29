<h4>Settings</h4>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="footer-tab" data-toggle="tab" href="#footer" role="tab" aria-controls="footer" aria-selected="false">Footer</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active ptb-20" id="about" role="tabpanel" aria-labelledby="about-tab"><?= $about ?></div>
    <div class="tab-pane fade ptb-20" id="footer" role="tabpanel" aria-labelledby="footer-tab"><?= $footer ?></div>
</div>
