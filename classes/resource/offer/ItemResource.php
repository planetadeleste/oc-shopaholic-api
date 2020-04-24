<?php namespace PlanetaDelEste\ApiShopaholic\Classes\Resource\Offer;

use Event;
use Illuminate\Http\Resources\Json\Resource;
use Lovata\Shopaholic\Classes\Helper\CurrencyHelper;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\Base\BaseResource;
use PlanetaDelEste\ApiShopaholic\Plugin;

/**
 * Class itemResource
 *
 * @mixin \Lovata\Shopaholic\Classes\Item\OfferItem
 * @package PlanetaDelEste\ApiShopaholic\Classes\Resource\Offer
 */
class ItemResource extends BaseResource
{
    /**
     * @return array|void
     */
    public function getData()
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'code'            => $this->code,
            'price'           => $this->price,
            'price_value'     => (float)$this->price_value,
            'old_price'       => $this->old_price,
            'old_price_value' => (float)$this->old_price_value,
            'quantity'        => $this->quantity,
            'currency'        => CurrencyHelper::instance()->getDefault()->symbol,
            'preview_text'    => $this->preview_text,
            'thumbnail'       => $this->preview_image ? $this->preview_image->getThumb(
                300,
                300,
                ['mode' => 'crop']
            ) : null,
            'text'            => $this->name,
            'value'           => $this->id,
        ];
    }

    protected function getEvent()
    {
        return Plugin::EVENT_ITEMRESOURCE_DATA;
    }
}
