<?php

namespace Ansuns\Pay\Gateways\Wechat;

use Ansuns\Pay\Gateways\Wechat;

/**
 * 微信POS刷卡支付网关
 * Class PosGateway
 * @package Pay\Gateways\Wechat
 */
class Pos extends Wechat
{

    /**
     * 当前操作类型
     * @return string
     */
    protected function getTradeType()
    {
        return 'MICROPAY';
    }

    /**
     * 应用并返回参数
     * @param array $options
     * @return array
     * @throws \Ansuns\Pay\Exceptions\GatewayException
     */
    public function apply(array $options = [])
    {
        $this->unsetTradeTypeAndNotifyUrl();
        if (isset($options['notify_url'])) {
            unset($options['notify_url']);
        }
        $this->gateway = $this->gateway_micropay;
        $result = $this->preOrder($options);
        if (!$this->isSuccess($result)) {
            $result['trade_state'] = ($result['err_code'] == 'USERPAYING') ? $result['err_code'] : 'PAYERROR'; //只要不是支付中,则认为支付失败
        }
        return $result;
    }

}
