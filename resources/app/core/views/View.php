<?php
namespace App\Core\Views;

use App\Interfaces\Views\ViewInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class View implements ViewInterface
{
    protected string $filename = "";
    protected array $variables = [];

    protected ?Request $request = null;

    /**
     * Creates a new view.
     * 
     * @param string $filename The name of the view file without the .php
     * extension, e.g. : helloworld OR folder/helloworld
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename.'.php';
    }

    /**
     * Registers the ServerRequestInterface (Request) with the view.
     * This will be used for some default variables.
     * 
     * @param Request $request An instantiated ServerRequestInterface (request)
     * object from the controller.
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Registers variables that can be used within the view.
     * 
     * @param array $variables an array of variables that will be made
     * availlable within the view.
     */
    public function withVariables(array $variables)
    {
        if(count($variables) > 0)
            $this->variables = array_merge($this->variables, $variables);
    }

    /**
     * Loads the view and prepares it.
     */
    public function load()
    {
        $this->variables['baseURL'] = ServerBase();

        if($this->request != null)
        {
            $pageURI = $this->variables['pageName'] = $this->request->getUri();
            $this->variables['currentPath'] = $pageURI->getPath();
        }
    }

    /**
     * Renders the view.
     * 
     * @return string Returns a string with the rendered view content.
     */
    public function render()
    {
        $content = "[ERROR] View is not initialized.";

        // Make all variables availlable to the view
        if(count($this->variables) > 0)
        {
            foreach($this->variables as $name => $value)
            {
                $$name = $value;
            }
        }

        // Render the contents but capture it so we can return it
        ob_start();
        require_once VIEW_DIR.$this->filename;
        $content = ob_get_clean();

        return $content;
    }
}