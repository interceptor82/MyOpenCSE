<?php
function show_message($messages) {
    if (isset($messages) && !empty($messages)) {
        $message = null;
        foreach ($messages as $type => $message_text) {
            if (is_array($message_text)) {
                foreach ($message_text as $m) {
                    switch ($type) {
                        case "success":
                            $message .= '<div class="alert alert-success">' . $m . '</div>';
                            break;
                        case "info":
                            $message .= '<div class="alert alert-info">' . $m . '</div>';
                            break;
                        case "warning":
                            $message .= '<div class="alert alert-warning">' . $m . '</div>';
                            break;
                        case "danger":
                            $message .= '<div class="alert alert-danger">' . $m . '</div>';
                            break;
                        case "important":
                            $message .= '<div class="alert navy"><h3>' . $m . '</h3></div>';
                            break;
                        default:

                            break;
                    }
                }
            } else {
                switch ($type) {
                    case "success":
                        $message .= '<div class="alert alert-success">' . $message_text . '</div>';
                        break;
                    case "info":
                        $message .= '<div class="alert alert-info">' . $message_text . '</div>';
                        break;
                    case "warning":
                        $message .= '<div class="alert alert-warning">' . $message_text . '</div>';
                        break;
                    case "danger":
                        $message .= '<div class="alert alert-danger">' . $message_text . '</div>';
                        break;
                    default:
                        $message .= $type;
                        break;
                }
            }
        }
        return $message;
    }
}

function icon($icon, $texte = null, $lien = null, $legende = null, $style = 'default', $popup = 0, $js = null, $formulaire = false, $navbar = false, $size = 'sm', $class = null, $typeicon = 'fas fa', $style_btn = null, $id = null) {
    switch ($size) {
        case 'xs':
            $img_size = 12;
            break;
        case 'sm':
            $img_size = 16;

            break;

        default:
            break;
    }

//        $src        = base_url() . '/app/ThirdParty/fontawesome-free-5.14.0-web/svgs/solid/' . $icon . '.svg';
        $img_button = '<span class="' . $typeicon . '-' . $icon . '" style="' . $style_btn . '"></span>';
    


    ($formulaire == false) ? $type         = 'button' : $type         = 'submit';
    ($navbar == false) ? $style_navbar = null : $style_navbar = 'navbar-btn';
    (!is_null($js) && !is_array($js) && strpos($js, 'data-toggle') !== false) ? $toggle       = null : $toggle       = 'data-toggle="tooltip"';
    if ($lien != null) {
        $decoupage = explode('/', $lien);
        $lien_ie   = null;
        for ($i = 1; $i < count($decoupage); $i++) {
            if ($i == (count($decoupage) - 1)) {
                $lien_ie .= $decoupage[$i];
            } else {
                $lien_ie .= $decoupage[$i] . '/';
            }
        }
    }
    if ($lien == null) {
        return '<button ' . $id . ' type="' . $type . '" class="' . $style_navbar . ' btn btn-' . $style . ' btn-' . $img_size . ' ' . $class . '" ' . $toggle . ' data-placement="bottom" title="' . $legende . '" ' . $js . '>' . $texte . '</button>';
    } elseif ($popup == 0) {
        return anchor($lien, '<button ' . $id . ' type="button" onclick="window.location(\'' . $lien_ie . '\')" class="' . $style_navbar . ' btn btn-' . $style . ' btn-' . $img_size . ' ' . $class . '" data-toggle="tooltip" data-placement="bottom" title="' . $legende . '">' . $img_button . $texte . '</button>', $js);
    } else {
        return anchor_popup($lien, '<button ' . $id . ' type="button" class="' . $style_navbar . ' btn btn-' . $style . ' btn-' . $img_size . ' ' . $class . '" data-toggle="tooltip" data-placement="bottom" title="' . $legende . '"><span class="' . $typeicon . '-' . $icon . '" style="' . $style_btn . '"></span>' . $texte . '</button>', $js);
    }
}

function single_icon($icon, $size = 'sm', $color='') {
        return '<span class="fa-solid fa-'.$icon.' fa-'.$size.' " style="color: '.$color.';"></span>';
}

function getVersion()
{
    switch (ENVIRONMENT) {
        case 'development':
            $lib = '<span style="background-color: #547ca3;border-radius: 5px;padding: 2px 5px 2px 5px;color: #fff;font-size: 12px;font-weight: bold;">DEV';
            break;
        case 'production':
        default:
            $lib = '<span style="background-color: #d74141;border-radius: 5px;padding: 2px 5px 2px 5px;color: #fff;font-size: 12px;font-weight: bold;">Version ';
            break;
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/version")) {
        $lib .= " : " . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/version");
    }
    return $lib . "</span>";
}