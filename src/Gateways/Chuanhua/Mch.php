<?php

namespace Ansuns\Pay\Gateways\Chuanhua;

use Ansuns\Pay\Exceptions\Exception;
use Ansuns\Pay\Exceptions\GatewayException;
use Ansuns\Pay\Exceptions\InvalidArgumentException;
use Ansuns\Pay\Gateways\Chuanhua;

/**
 * 商户配置
 * Class Mch
 * @package Pay\Gateways\Wechat
 */
class Mch extends Chuanhua
{

    /**
     * 发起支付
     * @param array $options
     * @return mixed
     * @throws Exception
     * @throws GatewayException
     */
    public function apply(array $options = [])
    {
        return $this->getResult($this->gateway);
    }

    /**
     * 查询进件信息
     * @param string $task_code
     * @return mixed
     * @throws Exception
     * @throws GatewayException
     */
    public function query_qrcode_product_info(string $task_code)
    {

        $this->service = "/MerchIncomeQuery/queryQrcodeProductInfo";
        $this->setConfig([
            'taskCode' => $task_code,
        ]);
        $result = $this->getResult();
        $data = [];
        if (!empty($result['repoInfo'])) {
            foreach ($result['repoInfo'] as $info) {
                if ($info['childNoType'] == 'WX') {
                    $data['mno'] = $info['mno'];
                    $data['sub_mch_id'] = $info['childNo'];
                }
            }
        }
        return $data ?: $result;
    }

    /**
     * 查询订单状态
     * @param string $out_trade_no 商户订单号
     * @return array
     * @throws GatewayException
     */
    public function find($out_trade_no = '')
    {
        return $this->getResult($this->gateway);
    }

    /**
     * @return string
     */
    protected function getTradeType()
    {
        return '';
    }
}