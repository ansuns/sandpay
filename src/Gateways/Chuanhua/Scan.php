<?php


namespace Ansuns\Pay\Gateways\Chuanhua;

use Ansuns\Pay\Gateways\Chuanhua;

/**
 * 微信扫码支付网关
 * Class ScanGateway
 * @package Pay\Gateways\Wechat
 */
class Scan extends Chuanhua
{

    /**
     * 当前操作类型
     * @return string
     */
    protected function getTradeType()
    {
        return 'NATIVE';
    }

    /**
     * 应用并返回参数
     * @param array $options
     * @return mixed
     * @throws \Ansuns\Pay\Exceptions\GatewayException
     */
    public function apply(array $options = [])
    {
        return $this->preOrder($options)['code_url'];
    }
}
