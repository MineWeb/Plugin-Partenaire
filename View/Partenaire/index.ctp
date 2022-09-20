<style type="text/css">

    .twt-column {
        padding: 10px;
        margin: 10px 10px 5px 0px;
        background-color: rgb(239,239,239);
        border-radius: 10px;
        float: left;
        max-width: 300px;


    }
    .fb-column {
        padding: 10px;
        margin: 10px 10px 5px 0px;
        background-color: rgb(239,239,239);
        border-radius: 10px;
        float: left;
        max-width: 470px;


    }
    .ytb-column {
        padding: 10px;
        margin: 10px 10px 5px 0px;
        background-color: rgb(239,239,239);
        border-radius: 10px;
        float: left;
        max-width: 300px;

    }
    .atr-column {
        padding: 10px;
        margin: 10px 10px 5px 0px;
        background-color: rgb(239,239,239);
        border-radius: 10px;
        float: left;
        max-width: 300px;

    }
    #pseudo {
        margin: 10px 0px 0px 0px;
        padding-bottom: 0px;
        text-align: center;
    }


</style>

<div id="heading-breadcrumbs">
    <div class="container">
        <h1><?= $Lang->get("PARTENAIRE"); ?></h1>
    </div>
</div>

<div id="content">
  <div class="container">
        <!-- Partie Youtube -->
        <?php if ($ytb): ?>
            <div class="row">
                <h2>Nos partenaires Youtube</h2>
            </div>
            <hr />

            <div class="row">
                <?php foreach ($partenaire as $p): ?>
                    <?php if ($p['Partenaire']['type'] == 'Y') { ?>
                        <div class="ytb-column" style="opacity: 1;">
                            <div id='pseudo'>
                                <div class="g-ytsubscribe" data-channel="<?= $p['Partenaire']['channel']; ?>" data-channelid="<?= $p['Partenaire']['channel']; ?>" data-layout="full" data-count="default"></div>
                            </div>
                            <h3 id='pseudo'><?= $p['Partenaire']['pseudo']; ?></h3>
                            <p><?= $p['Partenaire']['desc']; ?></p>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Partie Twitter -->
        <?php if ($twt): ?>
            <div class="row">
                <hr />
                <h2>Nos partenaires Twitter</h2>
            </div>
            <hr/>

            <div class="row">
                <?php foreach ($partenaire as $p): ?>
                    <?php if ($p['Partenaire']['type'] == 'T') { ?>
                        <div class="twt-column" style="opacity: 1;">
                            <div id='pseudo'>
                                <a class="twitter-follow-button" href="https://twitter.com/<?= $p['Partenaire']['channel']; ?>" data-size="large"></a>
                            </div>
                            <h3 id='pseudo'><?= $p['Partenaire']['pseudo']; ?></h3>
                            <p><?= $p['Partenaire']['desc']; ?></p>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Partie Facebook -->
        <?php if ($fb): ?>
            <div class="row">
                <hr />
                <h2>Nos partenaires Facebook</h2>
            </div>
            <hr />

            <div class="row">
                <?php foreach ($partenaire as $p): ?>
                    <?php if ($p['Partenaire']['type'] == 'F') { ?>
                        <div class="fb-column" style="opacity: 1;">
                            <div id='pseudo'>
                                <div class="fb-follow" data-href="https://www.facebook.com/<?= $p['Partenaire']['channel']; ?>" data-layout="standard" data-size="small" data-show-faces="true">
                                </div>
                            </div>
                            <h3 id='pseudo'><?= $p['Partenaire']['pseudo']; ?></h3>
                            <p><?= $p['Partenaire']['desc']; ?></p>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Partie Discord -->
        <?php if ($dis): ?>
            <div class="row">
                <hr />
                <h2>Nos partenaires Discord</h2>
            </div>
            <hr />

            <?php foreach ($partenaire as $p): ?>
                <?php if ($p['Partenaire']['type'] == 'D') { ?>
                    <div class="atr-column" style="opacity: 1;">
                        <div id='pseudo'>
                            <a target="_blank" href= "<?= $p['Partenaire']['link']; ?>"><h3 id='pseudo'><?= $p['Partenaire']['pseudo']; ?></h3></a>
                        </div>
                        <p><?= $p['Partenaire']['desc']; ?></p>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
            <hr />
       <?php endif; ?>
    </div>
  </div>

<!-- Google api -->
<script src="https://apis.google.com/js/platform.js"></script>

<!-- FaceBook api -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>

<!-- Twitter api -->
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
