<style>
        .div-size-css{
            height: 100%;
            margin: 0;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .error-container {
            max-width: 500px;
        }
        .error-image {
            / max-width: 100%; /
            height: auto;
			width: 70%;
        }

    </style>
    <section class="panel-space get-in-touch-panel">
        <div class="banner-slider-eee div-size-css">
            <div class="item">
                <div class="error-container mt-5 mb-5">
                    <!-- <img src="<?php //base_url('/public/assets/images/career-logo.png') ?>" alt="404 Error" class=" mb-4"> -->
                    <img src="<?=base_url('/public/404error.png')?>" alt="404 Error" class="error-image mb-4">
                    <p class="mb-4"></p>
                    <a href="<?=base_url();?>" class="btn btn-danger">Go Home</a>
                </div>
            </div>
        </div>
    </section>