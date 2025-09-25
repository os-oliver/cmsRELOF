<?
namespace App\Admin;

use App\Admin\PageBuilders\MissionPageBuilder;
use App\Controllers\AuthController;
use App\Models\Text;
use App\Models\Event;
use App\Models\Gallery;
use App\Admin\PageBuilders\BasePageBuilder;
use App\Admin\PageBuilders\GalleryPageBuilder;
use App\Admin\PageBuilders\ContactPageBuilder;
use App\Admin\PageBuilders\DocumentsPageBuilder;
use App\Admin\PageBuilders\BasicPageBuilder;
use App\Admin\PageBuilders\EventsPageBuilder;
use DOMDocument;
use DOMNode;
use DOMXPath;
use Exception;
class StaticPageExporter
{
    private array $data;
    private string $baseDir;
    private string $compDir;

    public function __construct($data)
    {
        error_log("Constructing PageExporter");
        if (!is_array($data)) {
            throw new \InvalidArgumentException("Data must be an array");
        }

        $this->data = $data;
        $this->baseDir = dirname(__DIR__, 2) . '/public/exportedPages';
        $this->compDir = $this->baseDir . '/landingPageComponents';
        $this->pagesDir = $this->baseDir . '/pages';

        error_log("Initializing directories");
        $this->ensureDirectories();
        error_log("PageExporter construction complete");
    }

}
?>