<?php
namespace App\Utils;
if (session_status() === PHP_SESSION_NONE) {
    // Session has not started
    session_start();
} else {
    // Session is already started
}

class CardRenderer
{
    public static function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null): string
    {
        $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');

        $html = "<form method='GET' action='' class='flex flex-col sm:flex-row items-center justify-between bg-white p-4 rounded-xl shadow-md mb-6 gap-4'>";

        // Search input with full width
        $html .= "<div class='flex w-full sm:w-auto flex-1 gap-2'>
                <input type='text' name='search' value='{$safeSearchValue}' placeholder='{{PRETRAGA}}...' 
                    class='w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow shadow-sm'>
                <button type='submit' class='bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition-all shadow-sm'>
                {{PRIMENI}}
                </button>
              </div>";

        // Category dropdown
        $html .= "<div class='flex items-center w-full sm:w-auto'>
                <select name='category' class='w-full sm:w-64 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow shadow-sm'>
                    <option value=''>{{kategorije}}</option>";

        foreach ($categories as $cat) {
            $id = htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8');
            $name = htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8');
            $selected = ($selectedCategoryId == $cat['id']) ? 'selected' : '';
            $html .= "<option value='{$id}' {$selected}>{$name}</option>";
        }

        $html .= "</select></div>";

        $html .= "</form>";

        $html = str_replace('{{PRIMENI}}', __('documents.apply'), $html);
        $html = str_replace('{{kategorije}}', __('documents.all_categories'), $html);
        $html = str_replace('{{PRETRAGA}}', __('dynamic.search'), $html);
        return $html;
    }

    public static function renderCard(array $item, array $fieldLabels, string $locale, bool $isEditable = false): string
    {

        $itemId = htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8');

        $fields = [];
        // Dodavanje običnih text polja
        foreach ($item['fields'] as $fn => $translations) {
            if (($fieldLabels[$fn]['type'] ?? '') === 'file')
                continue;
            $label = $fieldLabels[$fn]['label'][$locale] ?? $fieldLabels[$fn]['label']['en'] ?? $fn;
            $value = (string) ($translations[$locale] ?? reset($translations) ?? '');
            $value = mb_strlen($value) > 10 ? mb_substr($value, 0, 10) . '...' : $value;
            $fields[] = ['name' => $fn, 'label' => $label, 'value' => $value];
        }
        // Dodavanje kategorije kao polja
        if (!empty($item['category'])) {
            $catLabel = 'Kategorija';
            $catValue = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
            if ($catValue) {
                $fields[] = ['name' => 'category', 'label' => $catLabel, 'value' => $catValue];
            }
        }

        // Slika
        $imageUrl = null;
        if (!empty($item['image'])) {
            $imageUrl = htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8');
        } else {
            foreach ($fieldLabels as $fieldName => $fieldConfig) {
                if (($fieldConfig['type'] ?? '') === 'file' && isset($item['fields'][$fieldName])) {
                    $translations = $item['fields'][$fieldName];
                    $value = $translations[$locale] ?? reset($translations);
                    if ($value) {
                        $imageUrl = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                        break;
                    }
                }
            }
        }

        $html = "<div class='group relative bg-white rounded-lg shadow-sm overflow-hidden transition-transform transform hover:-translate-y-1 hover:shadow-lg border border-gray-100 max-w-sm'>";

        // Hover akcije za edit/view/delete
        if ($imageUrl) {
            $html .= "<div class='relative w-full h-40 overflow-hidden bg-gray-50'>
                <img src='{$imageUrl}' class='w-full h-full object-cover'>";
            if ($isEditable) {
                $html .= "
        <div class='absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-30'>
            <div class='mx-2 px-3 py-2 rounded-2xl bg-black/40 backdrop-blur-sm border border-white/10 flex items-center gap-3'>
                <a href='/sadrzaj?id={$itemId}&tip=generic_element' 
                    class='view-item flex items-center justify-center w-9 h-9 rounded-full bg-white/90 text-gray-800 hover:scale-105 shadow-sm' 
                    title='Pogledaj'>
                    <i class='fas fa-eye'></i>
                </a>
                <button class='edit-item flex items-center justify-center w-9 h-9 rounded-full bg-blue-500 text-white hover:scale-105 shadow-sm' data-id='{$itemId}' title='Uredi'>
                    <i class='fas fa-edit'></i>
                </button>
                <button class='delete-item flex items-center justify-center w-9 h-9 rounded-full bg-red-600 text-white hover:scale-105 shadow-sm' data-id='{$itemId}' title='Obriši'>
                    <i class='fas fa-trash'></i>
                </button>
            </div>
        </div>";
            }
            $html .= "</div>";
        } else if ($isEditable) {
            $html .= "
    <div class='absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-30'>
        <div class='mx-2 px-3 py-2 rounded-2xl bg-black/40 backdrop-blur-sm border border-white/10 flex items-center gap-3'>
            <a href='/sadrzaj?id={$itemId}&tip=generic_element' 
                class='view-item flex items-center justify-center w-9 h-9 rounded-full bg-white/90 text-gray-800 hover:scale-105 shadow-sm' 
                title='Pogledaj'>
                <i class='fas fa-eye'></i>
            </a>
            <button class='edit-item flex items-center justify-center w-9 h-9 rounded-full bg-blue-500 text-white hover:scale-105 shadow-sm' data-id='{$itemId}' title='Uredi'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='delete-item flex items-center justify-center w-9 h-9 rounded-full bg-red-600 text-white hover:scale-105 shadow-sm' data-id='{$itemId}' title='Obriši'>
                <i class='fas fa-trash'></i>
            </button>
        </div>
    </div>";
        }

        // Polja i kategorija
        $html .= "<div class='p-3'>";
        if (!empty($fields)) {
            $html .= "<div class='grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-700 mb-3'>";
            foreach ($fields as $f) {
                $safeLabel = htmlspecialchars($f['label'], ENT_QUOTES, 'UTF-8');
                $safeValue = nl2br(htmlspecialchars($f['value'], ENT_QUOTES, 'UTF-8'));
                $html .= "<div class='bg-gray-50 rounded-md p-2 border border-gray-100'>
                    <div class='text-xs text-gray-500 uppercase tracking-wide mb-1'>{$safeLabel}</div>
                    <div class='leading-tight'>{$safeValue}</div>
                  </div>";
            }
            $html .= "</div>";
        }

        $html .= "</div></div>";
        return $html;
    }





    public static function renderPagination(int $currentPage, int $totalPages, int $start, int $end, int $total, string $style = 'editor'): string
    {
        if ($style === 'editor') {
            return self::renderEditorPagination($currentPage, $totalPages, $start, $end, $total);
        } else {
            return self::renderPublicPagination($currentPage, $totalPages);
        }
    }

    private static function renderEditorPagination(int $currentPage, int $totalPages, int $start, int $end, int $total): string
    {
        $html = "<div class='flex flex-col items-center space-y-4 mt-8 bg-white p-6 rounded-xl shadow-md'>";
        $html .= "<div class='text-sm text-gray-600 font-medium'>Prikazano {$start}-{$end} od {$total} stavki</div>";
        $html .= "<div class='flex items-center space-x-2'>";

        // Previous
        if ($currentPage > 1) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
            $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg flex items-center space-x-2 transition-all'><i class='fas fa-chevron-left text-sm'></i><span>Prethodna</span></a>";
        } else {
            $html .= "<span class='bg-gray-100 text-gray-400 cursor-not-allowed px-4 py-2 rounded-lg flex items-center space-x-2'><i class='fas fa-chevron-left text-sm'></i><span>Prethodna</span></span>";
        }

        // Page numbers
        $html .= "<div class='flex items-center space-x-1'>";
        if ($currentPage > 3) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
            $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg transition-all font-medium'>1</a>";
            if ($currentPage > 4) {
                $html .= "<span class='px-3 text-gray-400'>...</span>";
            }
        }

        for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
            $class = $i === $currentPage ? 'bg-primary-600 text-white border-2 border-primary-600' : 'bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500';
            $html .= "<a href='{$url}' class='{$class} px-4 py-2 rounded-lg transition-all font-medium'>{$i}</a>";
        }

        if ($currentPage < $totalPages - 2) {
            if ($currentPage < $totalPages - 3) {
                $html .= "<span class='px-3 text-gray-400'>...</span>";
            }
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
            $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg transition-all font-medium'>{$totalPages}</a>";
        }
        $html .= "</div>";

        // Next
        if ($currentPage < $totalPages) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
            $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg flex items-center space-x-2 transition-all'><span>Sledeća</span><i class='fas fa-chevron-right text-sm'></i></a>";
        } else {
            $html .= "<span class='bg-gray-100 text-gray-400 cursor-not-allowed px-4 py-2 rounded-lg flex items-center space-x-2'><span>Sledeća</span><i class='fas fa-chevron-right text-sm'></i></span>";
        }

        $html .= "</div></div>";
        return $html;
    }

    private static function renderPublicPagination(int $currentPage, int $totalPages): string
    {
        $html = "<div class='pagination'>";

        // Previous
        if ($currentPage > 1) {
            $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
            $html .= "<a href='{$prevUrl}' class='page-link'><i class='fas fa-chevron-left'></i></a>";
        } else {
            $html .= "<span class='page-link' aria-disabled='true'><i class='fas fa-chevron-left'></i></span>";
        }

        // Page numbers
        $start = max(1, $currentPage - 2);
        $end = min($totalPages, $currentPage + 2);

        if ($start > 1) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
            $html .= "<a href='{$url}' class='page-link'>1</a>";
            if ($start > 2) {
                $html .= "<span class='px-2 text-gray-400'>...</span>";
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
            $class = $i === $currentPage ? 'page-link active' : 'page-link';
            $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
        }

        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $html .= "<span class='px-2 text-gray-400'>...</span>";
            }
            $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
            $html .= "<a href='{$url}' class='page-link'>{$totalPages}</a>";
        }

        // Next
        if ($currentPage < $totalPages) {
            $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
            $html .= "<a href='{$nextUrl}' class='page-link'><i class='fas fa-chevron-right'></i></a>";
        } else {
            $html .= "<span class='page-link' aria-disabled='true'><i class='fas fa-chevron-right'></i></span>";
        }

        $html .= "</div>";
        return $html;
    }
}