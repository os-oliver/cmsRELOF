<?php

function renderPerPageDropdown(int $currentItemsPerPage): string
{
    $perPageOptions = [9, 15, 30];

    if (!in_array($currentItemsPerPage, $perPageOptions)) {
        $currentItemsPerPage = $perPageOptions[1];
    }
    $html = '<form method="GET" id="perPageForm" class="inline-block mb-5 font-body">';
    $html .= '<label class="pr-2" for="per_page">' . __("items_per_page") . '</label>';

    $html .= '<select name="per_page" id="per_page" class="w-20 rounded-xl px-2 py-2 focus:outline-none focus:ring-2 transition-all shadow-sm bg-white/80 backdrop-blur-sm cursor-pointer" onchange="document.getElementById(\'perPageForm\').submit();">';

    foreach ($perPageOptions as $option) {
        $selected = ($currentItemsPerPage === $option) ? 'selected' : '';
        $html .= "<option value=\"{$option}\" {$selected}>{$option}</option>";
    }

    $html .= '</select>';

    foreach ($_GET as $key => $value) {
        if ($key === 'per_page' || $key === 'page') continue;

        if (is_array($value)) {
            foreach ($value as $v) {
                $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($v) . '">';
            }
        } else {
            $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }
    }

    $html .= '</form>';

    return $html;
}
