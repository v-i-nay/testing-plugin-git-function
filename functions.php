<?php
/**
 * Checkmate functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Checkmate 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'checkmate_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'checkmate_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'checkmate_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'checkmate_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'checkmate_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_enqueue_styles() {
		wp_enqueue_style(
			'checkmate-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'checkmate_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'checkmate_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'checkmate' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'checkmate_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'checkmate_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_pattern_categories() {

		register_block_pattern_category(
			'checkmate_page',
			array(
				'label'       => __( 'Pages', 'checkmate' ),
				'description' => __( 'A collection of full page layouts.', 'checkmate' ),
			)
		);

		register_block_pattern_category(
			'checkmate_post-format',
			array(
				'label'       => __( 'Post formats', 'checkmate' ),
				'description' => __( 'A collection of post format patterns.', 'checkmate' ),
			)
		);
	}
endif;
add_action( 'init', 'checkmate_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'checkmate_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return void
	 */
	function checkmate_register_block_bindings() {
		register_block_bindings_source(
			'checkmate/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'checkmate' ),
				'get_value_callback' => 'checkmate_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'checkmate_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'checkmate_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Checkmate 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function checkmate_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;




function tryout_form_multistep_scripts() {
    if ( is_page('tryout') ) : ?>
        <style>
           .Try-out-form {
    background: rgba(255, 255, 255, 0.25) !important;
    backdrop-filter: blur(15px) !important;
    -webkit-backdrop-filter: blur(15px) !important;
    padding: 25px 20px !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
    max-width: 700px !important;
    margin: 20px auto !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}


            .Try-out-form .form-step {
                display: none;
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.4s ease;
                position: absolute;
                width: 100%;
                z-index: 0;
                pointer-events: none;
            }

            .Try-out-form .form-step.active {
                display: block;
                opacity: 1;
                transform: translateY(0);
                position: relative;
                z-index: 1;
                pointer-events: auto;
            }

            .Try-out-form .wpforms-field-container {
                position: relative;
                min-height: 280px !important;
                margin-bottom: 25px !important;
				background-color:transparent !important;
				border:none !important;
            }

            .Try-out-form .step-indicator {
                display: flex !important;
                justify-content: center !important;
                gap: 10px !important;
                margin-bottom: 25px !important;
            }

            .Try-out-form .step-indicator .step-dot {
                width: 20px !important;
                height: 20px !important;
                       background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/basketball-animation.png') !important;
                background-size: cover !important;
                background-position: center !important;
                border-radius: 50% !important;
                opacity: 0.5 !important;
                transition: opacity 0.3s, transform 0.3s !important;
                filter: grayscale(100%) !important;
            }

            .Try-out-form .step-indicator .step-dot.active {
                opacity: 1 !important;
                transform: scale(1.2) !important;
                filter: none !important;
            }

            .Try-out-form .step-nav {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 15px !important;
                margin-top: 20px !important;
				display:inline !important;
            }

            .Try-out-form .step-nav button {
                padding: 10px 22px !important;
                background: #ffffff !important;
                color: #000000 !important;
                border: none !important;
                border-radius: 6px !important;
                cursor: pointer !important;
                font-size: 15px !important;
                transition: background 0.3s ease !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1) !important;
               transition: background 0.3s ease !important;

/*   background-repeat: no-repeat, repeat !important;
  background-position: left center, 0 0 !important;
  background-size: 0 100%, auto !important; */
  border-radius: 128px !important;
            }

/*             .Try-out-form .step-nav button:hover:not(:disabled) {
                background: #003f7d !important;
                
            } */

            .Try-out-form .step-nav button[disabled] {
                background: #ccc !important;
                cursor: not-allowed !important;
            }

            .Try-out-form .wpforms-field input[type="text"],
            .Try-out-form .wpforms-field input[type="email"],
            .Try-out-form .wpforms-field input[type="tel"],
            .Try-out-form .wpforms-field select,
            .Try-out-form .wpforms-field textarea {
                width: 100% !important;
                padding: 10px 14px !important;
                border: 1px solid #ccc !important;
                border-radius: 6px !important;
                font-size: 15px !important;
                margin-top: 3px !important;
                margin-bottom: 16px !important;
                transition: border-color 0.3s, box-shadow 0.3s !important;
				
				
            }
			
			.Try-out-form .wpforms-field input[type="text"],
            .Try-out-form .wpforms-field input[type="email"],
            .Try-out-form .wpforms-field input[type="tel"],
			.Try-out-form .wpforms-field select{
				height:100% !important;
			}

            .Try-out-form .wpforms-field input:focus,
            .Try-out-form .wpforms-field textarea:focus,
            .Try-out-form .wpforms-field select:focus {
                border-color: #0055aa !important;
                box-shadow: 0 0 0 2px rgba(0, 85, 170, 0.2) !important;
                outline: none !important;
            }

            .Try-out-form .wpforms-field label {
                font-weight: 600 !important;
                display: block !important;
                margin-bottom: 5px !important;
                color: #333 !important;
            }

            .Try-out-form .wpforms-submit-container {
                text-align: center !important;
                margin-top: 25px !important;
				display:inline !important;
            }

            .Try-out-form .wpforms-submit{
                background-color: #1B5FAA !important;
                color: #fff !important;
                padding: 12px 28px !important;
                font-size: 15px !important;
                border-radius: 6px !important;
                border: none !important;
                cursor: pointer !important;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1) !important;
                transition: background 0.3s ease !important;
background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/basketball-animation.png') , 
                    linear-gradient(101.12deg, #2563eb, #1b5faa 48%, #1e3a8a) !important;
  background-repeat: no-repeat, repeat !important;
  background-position: left center, 0 0 !important;
  background-size: 0 100%, auto !important;
  border-radius: 128px !important;
				
            }

            .Try-out-form .wpforms-submit:hover {
                background-color: transparent !Important;
  background-position: right center, 0 0 !important;
  background-size: auto 100%, auto !important;
cursor:pointer !important;
            }
			.wpforms-field-divider h3{
				color:#ffffff !important;
				text-transform:none !important;
			}
            
  .field-error {
    border: 2px solid red !important;
    border-radius: 4px;
}
			
@media (max-width: 768px) {
    .step-error-msg {
        display: block !important;
        padding-left: 0 !important;
    }
}
.hide-important {
    display: none !important;
}

			
        </style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.Try-out-form form');
    if (!form) return;

    const stepGroups = [
        ['#wpforms-201-field_78-container', '#wpforms-201-field_62-container'],
        ['#wpforms-201-field_45-container', '#wpforms-201-field_65-container'],
        ['#wpforms-201-field_33-container', '#wpforms-201-field_64-container'],
        ['#wpforms-201-field_36-container']
    ];

    const steps = [];
    stepGroups.forEach(group => {
        const stepDiv = document.createElement('div');
        stepDiv.classList.add('form-step');
        group.forEach(selector => {
            const el = document.querySelector(selector);
            if (el) stepDiv.appendChild(el);
        });
        steps.push(stepDiv);
    });

    const fieldContainer = form.querySelector('.wpforms-field-container');
    fieldContainer.innerHTML = '';
    steps.forEach(step => fieldContainer.appendChild(step));

    const indicator = document.createElement('div');
    indicator.className = 'step-indicator';
    steps.forEach(() => {
        const dot = document.createElement('div');
        dot.className = 'step-dot';
        indicator.appendChild(dot);
    });
    form.insertBefore(indicator, fieldContainer);

    const nav = document.createElement('div');
    nav.className = 'step-nav';
    nav.innerHTML = `
        <button type="button" class="prev-step">Back</button>
        <button type="button" class="next-step">Next</button>
    `;
    form.insertBefore(nav, form.querySelector('.wpforms-submit-container'));

    // Create error message element
    const errorMsg = document.createElement('div');
    errorMsg.className = 'step-error-msg hide-important'; // initially hidden with !important
    errorMsg.textContent = 'Please complete the required fields';
    errorMsg.style.color = 'red';
    errorMsg.style.marginTop = '10px';
	errorMsg.style.display = 'inline';
    nav.appendChild(errorMsg);

    const nextBtn = nav.querySelector('.next-step');
    const prevBtn = nav.querySelector('.prev-step');
    const submitBtn = form.querySelector('.wpforms-submit');
    const dots = indicator.querySelectorAll('.step-dot');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => step.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
        prevBtn.disabled = index === 0;
        nextBtn.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = index === steps.length - 1 ? 'inline-block' : 'none';
        errorMsg.classList.add('hide-important'); 
    }

    nextBtn.addEventListener('click', () => {
        const currentFields = steps[currentStep].querySelectorAll('input, select, textarea');
        let isValid = true;

        currentFields.forEach(field => {
            if (field.hasAttribute('required') && !field.value.trim()) {
                isValid = false;
                field.classList.add('field-error');
            } else {
                field.classList.remove('field-error');
            }
        });

        if (!isValid) {
            errorMsg.classList.remove('hide-important'); // Show error
            errorMsg.style.paddingLeft = '2%';
            const firstInvalid = steps[currentStep].querySelector('.field-error');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        } else {
            errorMsg.classList.add('hide-important'); // Hide error
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    submitBtn.style.display = 'none';
    showStep(0);
});

</script>


        
    <?php endif;
}
add_action('wp_footer', 'tryout_form_multistep_scripts');

function preload_custom_font_files() {
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/BebasNeue-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
	echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/Poppins-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
}
add_action('wp_head', 'preload_custom_font_files');


// ---------QR
function donation_gateway_shortcode() {
    // Get the 'Donation' post of type 'donate'
    $post = get_page_by_title('Donation', OBJECT, 'donate');
    if (!$post) return 'Donation post not found.';

    $post_id = $post->ID;

    // Get ACF fields
    $venmo = get_field('qr_venmo', $post_id);
    $paypal = get_field('qr_paypal', $post_id);
    $cashapp = get_field('qr_cashapp', $post_id);
    $zelle = get_field('zelle_info', $post_id);

    ob_start(); ?>
    <div class="donation-gateway-container" style="display: flex; gap: 40px; max-width: 800px; margin: auto; padding: 20px; border-radius: 12px; background:#ffffff; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <div class="gateway-list" style="flex: 1;">
            <p class="gateway-option active" data-gateway="venmo">Venmo</p>
            <p class="gateway-option" data-gateway="paypal">Paypal</p>
            <p class="gateway-option" data-gateway="cashapp">Cash App</p>
            <p class="gateway-option" data-gateway="zelle">Zelle</p>
        </div>
        <div class="gateway-display" style="flex: 2; text-align: center;">
            <img id="qr-image" src="<?= esc_url($venmo) ?>" alt="QR Code" style="max-width: 300px; display: block; margin: auto;">
            <div id="zelle-info" style="display: none; font-size: 18px; margin-top: 20px;color:#000000;"><?= esc_html($zelle) ?></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const qrImage = document.getElementById('qr-image');
        const zelleInfo = document.getElementById('zelle-info');

        const data = {
            venmo: '<?= esc_url($venmo) ?>',
            paypal: '<?= esc_url($paypal) ?>',
            cashapp: '<?= esc_url($cashapp) ?>',
        };

        document.querySelectorAll('.gateway-option').forEach(el => {
            el.addEventListener('click', () => {
                const gateway = el.getAttribute('data-gateway');

                document.querySelectorAll('.gateway-option').forEach(e => e.classList.remove('active'));
                el.classList.add('active');

                if (gateway === 'zelle') {
                    qrImage.style.display = 'none';
                    zelleInfo.style.display = 'block';
                } else {
                    qrImage.src = data[gateway];
                    qrImage.style.display = 'block';
                    zelleInfo.style.display = 'none';
                }
            });
        });
    });
    </script>
    <style>
    .gateway-option {
        cursor: pointer;
        padding: 10px;
        border-radius: 8px;
		color:#000000;
		text-align:center;
		border:1px solid #1B5FAA;
    }
    .gateway-option.active {
        background-color: #1B5FAA;
        font-weight: bold;
		color:#ffffff;
		border:none !important;
    }
		@media (max-width: 480px){
			.donation-gateway-container{
				width:90% !important;
			}
		}
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('donation_gateways', 'donation_gateway_shortcode');

// ----------donation popup

function donation_form_popup_shortcode() {
    ob_start(); ?>
    
    <div id="donation-form-popup" class="donation-form-popup" style="display: none;">
        <div class="donation-form-popup-inner">
            <span class="close-popup">&times;</span>
            <h3>Did you already make a donation and would like a receipt?<br>Please complete the form below</h3>
            <?php echo do_shortcode('[wpforms id="651"]'); ?>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const button = document.querySelector(".donation-popup-button");
        const popup = document.getElementById("donation-form-popup");
        const closeBtn = popup.querySelector(".close-popup");

        if (button && popup && closeBtn) {
            button.addEventListener("click", function () {
                popup.style.display = "flex";
            });

            closeBtn.addEventListener("click", function () {
                popup.style.display = "none";
            });

            window.addEventListener("click", function (e) {
                if (e.target === popup) {
                    popup.style.display = "none";
                }
            });
        }
    });
    </script>

    <style>
    #donation-form-popup {
        position: fixed;
        z-index: 9999;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
		max-width:100% !important;
    }

    .donation-form-popup-inner {
        position: relative;
        background: #fff;
        border-radius: 12px;
        padding: 30px 40px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(29, 78, 216, 0.2);
border: 1px solid #1B5FAA;

    }

    .donation-form-popup-inner h3 {
        margin-bottom: 25px;
        font-size: 20px;
        font-weight: 500;
        color: #333;
        text-align: center;
    }

    .close-popup {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        font-weight: bold;
        color: #1B5FAA;
        cursor: pointer;
    }

    .wpforms-form input,
    .wpforms-form textarea,
    .wpforms-form select {
        width: 100% !important;
        max-width: 100% !important;
        padding: 12px 15px;
        margin-bottom: 15px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .wpforms-form input::placeholder,
    .wpforms-form textarea::placeholder {
        color: #999;
    }

    .wpforms-form input:focus,
    .wpforms-form textarea:focus {
        border-color: #e3663f;
        outline: none;
    }

    .wpforms-submit {
        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/basketball-animation.png') , 
                    linear-gradient(101.12deg, #2563eb, #1b5faa 48%, #1e3a8a) !important;
  background-repeat: no-repeat, repeat !important;
  background-position: left center, 0 0 !important;
  background-size: 0 100%, auto !important;
  border-radius: 128px !important;
        color: #ffffff !important;
        border: none;
        padding: 15px 25px !important;
        font-size: 16px;
        border-radius: 30px;
        cursor: pointer;
transition: background 0.3s ease !important;
        box-shadow: 0 6px 12px rgba(227, 102, 63, 0.3);
    }

    .wpforms-submit:hover {
          background-color: transparent !Important;
  background-position: right center, 0 0 !important;
  background-size: auto 100%, auto !important;
cursor:pointer !important;
    }
    </style>

    <?php
    return ob_get_clean();
}
add_shortcode('donation_popup', 'donation_form_popup_shortcode');

function dynamic_year_shortcode() {
    return date('Y');
}
add_shortcode('year', 'dynamic_year_shortcode');

$vari="something-need-to-commit";

