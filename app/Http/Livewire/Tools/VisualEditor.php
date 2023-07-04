<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tools;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;

class VisualEditor extends Component
{
    public $components = [];

    public $logoUrl = '';

    public $menuItems = [];
    public $cardContent = [];
    public $listItems = [];
    public $headerLayout = [];
    public $footerLayout = [];
    public $accordionItems = [];
    public $tabItems = [];

    public $selectedColors = [];

    public $title = 'page';

    public $colorOptions = [];

    public $colors;

    public $selectedColor;
    public $breadcrubType;
    public $breadcrubImage;
    public $textContent;
    public $themeColors = [];

    public $breadcrumbsSettings = [];
    public $pageLoaderSettings = [];

    protected $listeners = ['addComponent'];

    public function mount(): void
    {
        $this->components = [
            'listItems' => array_map(function ($item) {
                return ['itemText' => $item['itemText']];
            }, $this->listItems),
            'tabItems' => array_map(function ($item) {
                return [
                    'title'   => $item['title'],
                    'content' => $item['content'],
                ];
            }, $this->tabItems),
            'accordionItems' => array_map(function ($item) {
                return [
                    'title'   => $item['title'],
                    'content' => $item['content'],
                ];
            }, $this->accordionItems),
            'textContent' => [],
            'cardContent' => [],
            'layout'      => [
                'columns' => 2,
                'rows'    => 1,
                'content' => [],
            ],
            'sections' => [],
            'videos'   => [],
        ];
        $this->headerLayout = [
            'numberOfColumns' => 1,
            'headerHeight'    => 100,
            'logoUrl'         => null,
            'logoSize'        => 50,
            'logoPosition'    => 'left',
            'hasSearchIcon'   => false,
            'searchIcon'      => null,
        ];

        $this->footerLayout = [
            'numberOfColumns' => 1,
            'headerHeight'    => 100,
            'logoUrl'         => null,
            'logoSize'        => 50,
            'logoPosition'    => 'left',
            'hasSearchIcon'   => false,
            'searchIcon'      => null,
        ];

        $this->breadcrumbsSettings = [
            'isCentered' => true,
            'isSimple'   => false,
        ];

        $this->pageLoaderSettings = [
            'backgroundColor' => '#ffffff',
            'color'           => '#000000',
            'customLoader'    => null,
        ];

        // $this->menuItems = [
        // 'menuName' => '',
        //     'items' => [
        //         [
        //             'label' => '',
        //             'url' => ''
        //         ]
        //     ],
        // ];
        $this->colors = ['gray', 'red', 'green', 'blue', 'indigo'];
        $this->colorOptions = [100, 200, 300, 400, 500, 600, 700, 800, 900];
        $this->selectedColor = 'gray';
    }

    public function selectedColor($color): void
    {
        $this->selectedColor = $color;
    }

    public function selectedColors($index, $color): void
    {
        $selectedColors = $this->selectedColors;

        // Check if the selected color already exists in the array
        $colorExists = array_filter($selectedColors, function ($value) use ($color) {
            return $value === $this->selectedColor.'-'.$color;
        });

        // If the selected color does not exist, add it to the array
        if (empty($colorExists)) {
            // If there are already 8 colors in the array, remove the first one
            if (count($selectedColors) === 8) {
                array_shift($selectedColors);
            }

            // Add the selected color to the end of the array
            $selectedColors[] = $this->selectedColor.'-'.$color;
        }

        // Update the selectedColors property
        $this->selectedColors = array_map(function ($index, $value) {
            return [$index => $value];
        }, array_keys($selectedColors), $selectedColors);
    }

    public function addTextContent(): void
    {
        $this->components['textContent'][] = [
            'textContent' => '',
        ];
    }

    public function addLogo($logoUrl): void
    {
        $this->components['logo'] = $logoUrl;
    }

    public function addComponent($type, $props = []): void
    {
        $component = [
            'type'     => $type,
            'props'    => $props,
            'children' => [],
        ];

        array_push($this->components, $component);
    }

    public function addLayout(): void
    {
        $this->components['layout'] = [
            'columns' => 2,
            'rows'    => 1,
            'content' => [],
        ];
    }

    public function addSection($bgColor = null): void
    {
        $this->components['sections'][] = [
            'bgColor' => $bgColor,
            'content' => [],
        ];
    }

    public function addColumn($width = 1): void
    {
        $this->components['layout']['content'][] = [
            'type'    => 'column',
            'width'   => $width,
            'content' => [],
        ];
    }

    public function addVideo($url = '', $autoplay = false): void
    {
        $this->components['videos'][] = [
            'url'      => $url,
            'autoplay' => $autoplay,
        ];
    }

    public function saveBreadcrumbs(): void
    {
        $breadcrumbs = [
            'type'  => $this->breadcrumbType,
            'image' => $this->breadcrumbType === 'image' ? $this->breadcrumbImage : null,
        ];

        // Save the values to the breadcrumbsSettings component
        $this->breadcrumbsSettings = $breadcrumbs;
    }

    public function saveLoader(): void
    {
        $loader = [
            'backgroundColor' => $this->pageLoaderSettings['backgroundColor'],
            'color'           => $this->pageLoaderSettings['color'],
            'customLoader'    => $this->pageLoaderSettings['customLoader'],
        ];

        // Save the values to the pageLoaderSettings component
        $this->pageLoaderSettings = $loader;
    }

    // Menu manipulation
    public function addMenu(): void
    {
        $this->menuItems[] = [
            'menuName' => '',
            'items'    => [
                [
                    'label' => '',
                    'url'   => '',
                ],
            ],
        ];
    }

    public function removeMenu($index): void
    {
        unset($this->menuItems[$index]);
        $this->menuItems = array_values($this->menuItems);
    }

    public function addMenuItem($index): void
    {
        $this->menuItems[$index]['items'][] = [
            'label' => '',
            'url'   => '',
        ];
    }

    public function removeMenuItem($menuIndex, $itemIndex): void
    {
        unset($this->menuItems[$menuIndex]['items'][$itemIndex]);
        $this->menuItems[$menuIndex]['items'] = array_values($this->menuItems[$menuIndex]['items']);
    }

    public function saveMenuItems(): void
    {
        foreach ($this->menuItems as $index => $menu) {
            $menuName = $menu['menuName'];

            foreach ($menu['items'] as $item) {
                $label = $item['label'];
                $url = $item['url'];
            }
        }
    }

    public function usePredefinedMenu(): void
    {
        $this->menuItems[] = [
            'menuName' => 'Main Menu',
            'items'    => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'About', 'url' => '/about'],
                ['label' => 'Contact', 'url' => '/contact'],
            ],
        ];
    }

    // Header settings
    public function saveHeaderSettings(): void
    {
        $column = [
            'numberOfColumns' => $this->headerLayout['numberOfColumns'],
            'headerHeight'    => $this->headerLayout['headerHeight'],
            'logoUrl'         => $this->headerLayout['logoUrl'],
            'logoSize'        => $this->headerLayout['logoSize'],
            'logoPosition'    => $this->headerLayout['logoPosition'],
            'hasSearchIcon'   => $this->headerLayout['hasSearchIcon'],
            'searchIcon'      => $this->headerLayout['searchIcon'],
        ];

        // Save the values to the headerLayout component
        $this->headerLayout[] = $column;
    }

    // Footer settings
    public function saveFooterSettings(): void
    {
        $column = [
            'numberOfColumns' => $this->footerLayout['numberOfColumns'],
            'footerHeight'    => $this->footerLayout['footerHeight'],
            'hasSocialIcons'  => $this->footerLayout['hasSocialIcons'],
            'socialIcons'     => $this->footerLayout['socialIcons'],
        ];

        // Save the values to the footerLayout component
        $this->footerLayout[] = $column;
    }

    public function addCardContent(): void
    {
        $this->cardContent[] = [
            'cardImage'      => '',
            'cardTitle'      => '',
            'cardText'       => '',
            'cardButtonText' => '',
            'cardButtonLink' => '',
            'cardBgColor'    => '',
            'cardTextColor'  => '',
            'cardSize'       => '',
        ];
    }

    public function saveCardContent(): void
    {
        $this->cardContent = array_map(function ($item) {
            return [
                'cardImage'      => $item['cardImage'],
                'cardTitle'      => $item['cardTitle'],
                'cardText'       => $item['cardText'],
                'cardButtonText' => $item['cardButtonText'],
                'cardButtonLink' => $item['cardButtonLink'],
                'cardBgColor'    => $item['cardBgColor'],
                'cardTextColor'  => $item['cardTextColor'],
                'cardSize'       => $item['cardSize'],
            ];
        }, $this->cardContent);
    }

    public function removeCardContent($itemIndex): void
    {
        unset($this->cardContent[$itemIndex]);
        $this->cardContent = array_values($this->cardContent);
    }

    // accordion items manipulation
    public function addAccordionItem(): void
    {
        $this->components['accordionItems'][] = [
            'title'   => '',
            'content' => '',
        ];
    }

    public function saveAccordionItems(): void
    {
        $this->components['accordionItems'] = array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'content' => $item['content'],
            ];
        }, $this->components['accordionItems']);
    }

    public function removeAccordionItem($itemIndex): void
    {
        unset($this->components['accordionItems'][$itemIndex]);
        $this->components['accordionItems'] = array_values($this->components['accordionItems']);
    }

    // tab items manipulation
    public function addTabItem(): void
    {
        $this->components['tabItems'][] = [
            'title'   => '',
            'content' => '',
        ];
    }

    public function saveTabItems(): void
    {
        $this->components['tabItems'] = array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'content' => $item['content'],
            ];
        }, $this->components['tabItems']);
    }

    public function removeTabItem($itemIndex): void
    {
        unset($this->components['tabItems'][$itemIndex]);
        $this->components['tabItems'] = array_values($this->components['tabItems']);
    }

    // list items manipulation
    public function addListItem(): void
    {
        $this->components['listItems'][] = [
            'itemText' => '',
        ];
    }

    public function saveListItems(): void
    {
        $this->listItems = array_map(function ($item) {
            return ['itemText' => $item['itemText']];
        }, $this->components['listItems']);
    }

    public function removeListItem($index): void
    {
        unset($this->components['listItems'][$index]);
        $this->components['listItems'] = array_values($this->components['listItems']);
    }

    public function removeComponent($componentIndex): void
    {
        unset($this->components[$componentIndex]);
        $this->components = array_values($this->components);
    }

    public function removeCard($cardIndex): void
    {
        unset($this->cardContent[$cardIndex]);
        $this->cardContent = array_values($this->cardContent);
    }

    public function removeTextContent($itemIndex): void
    {
        $this->textContent[$itemIndex] = '';
        unset($this->textContent[$itemIndex]);
    }

    public function removeLogo(): void
    {
        $this->logoUrl = '';
        unset($this->logoUrl);
    }

    public function removeColor($index): void
    {
        unset($this->selectedColors[$index]);
    }

    public function createPage(): void
    {
        // Convert the components data to a string
        $components = json_encode([
            'cardContent' => $this->cardContent,
            'menuItems'   => $this->menuItems,
            // Add other components data here...
        ]);
        $name = Str::snake($this->title);
        $content = '';

        foreach (json_decode($components, true) as $component) {
            $content .= '<x-'.$component['type'].' ';

            foreach ($component['attributes'] as $key => $value) {
                $content .= $key.'="'.$value.'" ';
            }

            $content .= '>'.PHP_EOL;

            if ( ! empty($component['slot'])) {
                $content .= '{{ $'.$component['slot'].' }}';
            }

            $content .= '</x-'.$component['type'].'>'.PHP_EOL;
        }

        File::put(resource_path('views/pages/'.$name.'.blade.php'), $content);
    }

    public function render(): View
    {
        return view('livewire.tools.visual-editor');
    }
}
