<?php
namespace Karim\Extracharge\Plugin\Checkout\Model;


class ShippingInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Karim\Extracharge\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Karim\Extracharge\Helper\Data $dataHelper
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Karim\Extracharge\Helper\Data $dataHelper
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $Extracharge = $addressInformation->getExtensionAttributes()->getFee();
        $quote = $this->quoteRepository->getActive($cartId);
        if ($Extracharge) {
            $fee = $this->dataHelper->getExtrafee();
            $quote->setFee($fee);
        } else {
            $quote->setFee(NULL);
        }
    }
}

