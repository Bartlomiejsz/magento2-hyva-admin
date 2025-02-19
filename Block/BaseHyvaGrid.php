<?php declare(strict_types=1);

namespace Hyva\Admin\Block;

use Hyva\Admin\ViewModel\HyvaGridInterface;
use Hyva\Admin\ViewModel\HyvaGridInterfaceFactory;
use Magento\Framework\View\Element\Template;

abstract class BaseHyvaGrid extends Template
{
    private HyvaGridInterfaceFactory $gridFactory;

    public function __construct(
        Template\Context $context,
        string $gridTemplate,
        HyvaGridInterfaceFactory $gridFactory,
        array $data = []
    ) {
        $this->setTemplate($gridTemplate);
        parent::__construct($context, $data);
        $this->gridFactory = $gridFactory;
    }

    public function getGrid(): HyvaGridInterface
    {
        if (!$this->getData('grid_name')) {
            $msg = 'The name of the hyvä grid configuration needs to be configured in the block arguments.';
            throw new \LogicException($msg);
        }

        return $this->gridFactory->create(['gridName' => $this->getData('grid_name')]);
    }
}
