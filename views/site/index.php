<?php

/* @var $this yii\web\View */

$this->title = 'Car Dealer Media - Admin Area';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Car Dealer Media</h1>

        <p class="lead">Maintenance area for Car Dealer</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Dealers</h2>

                <p>Here you can amend dealer details. These include contact details, address, telephone email address etc </p>

                <p><a class="btn btn-default" href="/dealer">Dealers &raquo;</a><a class="btn btn-default" href="/dealer/gmbposts">GMB Adverts &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Towns</h2>

                <p>This maintains the towns that may be used as centres of searches. Data items such as Longitude and Latitude as well as Postcode Outcode {the bit before the gap in a postcode}</p>

                <p><a class="btn btn-default" href="/town">Towns &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Vehicles</h2>

                <p>View and amend vehicle details.</p>

                <p><a class="btn btn-default" href="/vehicle">Cars &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
