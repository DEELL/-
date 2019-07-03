<?php
return[
    //应用ID,您的APPID。
    'app_id' => "2016092500596176",
//    商户ID
    'seller_id' => "2088102177264820",
    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEApQQNdytJ59UnFzSRKvswhLi1cDaBo3VK7Bj5WWKJfDFbhZddTYqLQJ7hGZp9xHHG6/qf2+ZasqZIejmyy/E8lRLr4KENH6YDREsaoDHm3N4BqzRU8gaKW6Q+LLfuCuIOljEjdMv1h6grFyyOQtDf8adtOd7W3ug9Ttp32y4JRojtiuF+JvAUfk+dwph+myuW1ZIGo+2ZdW+DZXrCA8OgDBMLpoDVx3YooIeBHvoe3noasLVAYS2hbKFwXKlahMvCA0+GiHQfON4TmZvwakIOkwo1eN0znLvztXcbsA29toG6KB81JizU2h0tAoGMF1ocuzCSUKWN/EnNUBx9OKJTxQIDAQABAoIBAHYJaxRmS6xgxWCNApZLLc6STX7iDmN9QEWYK6zrlkrXB4+M0Xno82ka/QuSfgoqFM+x6+2hXhlSZp+/bA0EF4DPExkQOtH7r3SHgJk8eNZem7T6bxTc5tVcq/jS7JyuTR7UMXeXeZ87BO/DuFNFFBvI1pHBu9OhLlGcZoXK7Wmc3Hq/O12lLSrZaJcAbUpS2zLmM4qAb3pj+aZxPp1ERIuoGK5PPAZ6Z7uLf81jdIFeftTjiUmZAGP2L8VBf/4zS119Sf/kAYBJif6Ta5vK9R/NZLLx/RaXSW0XQlk7GKv3Oa/En2de1K/NYWLdDDnNsJImJhqH6GuncCVTPiLaBCECgYEA1jX5K0ylpGZActE3XVlueHCbe96+55JheTwNsh+NvR3NV17puzsZgeNU9S9KUw2Yp2wfKqsLkCl+wMhLpCEpTyGlKn+mwC7ylHeZWAkg/EnDGOD9MZWOwOkLd4sIwoPhfdESBNCdm5dl0DgV1EVmBqQ3aCRRzyXRP7gataD1up0CgYEAxTU0Cx0sKfGLyxM7Mncg+/WhUqUjXoAcxHZlxBuy8mFE6Rmz+pv3e23fIqxXhZWt7QbayBQ7sJxNhx9/HuU8WtEPlFiKsodB7JnMJj2bzgxuEn6IaPOIIfi1tygbnfgwkuOtlwU5LpNg3H3jyoY/+riDQ2NCB9oaaKnJEOdzgUkCgYEArs1Mj7D0Wru2S/u+mkaoh1AdEXAriP1C3ZPL+VcWawUu0+V4BnmrzvqcEZiNpkiqEbWBmWgK/5FdBiRs1XraIuDpz0xr3thwzAbs85I/gKEQu/SdqSDKZVHHMb4bX+AO2oUJlzRF6Poa81dROO+I2lKXhDxfJhNONhkecqju3WECgYBMbaUg1YqDKujJqEdd9Itk+rot5HBDtJTxkw03pqCAjS/+wwZcjsuoG1nJ/07gJ7VDUk/CEQ1dEgZ94rgKij8M108ZaANA02i6QJS9EU1r2qdiJYXKXu+YcuJB/JpPa5uvoetpxw11PorgiS2aFNOA4LeGi1ZQ4rcvbvXMxlaeeQKBgQDG3DSxdAer1uaKqWVY3q7bITpSCjHIpWxBnvkcSc+oI3oWonYsPM3xeBcU2nPRuEX/WHn/nS39GQ658ITM935gm/a8yAyEGGJojVyjW29+TRtJDxhqgc6VoVfKQgW8arqTIKX/LcuwAVlDGFW7CRuXYi1INOhEQvjxxfO9vmf5bQ==",

    //异步通知地址
    'notify_url' => "http://39.96.205.6/zhubao/notify",

    //同步跳转k
    'return_url' => "www.1652985062.com/zhubao/returnpay",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA11r3S1JZ9G4+p/rfPiXtpMXLgmIYgy4e6xA+LHpa6+Nui+/6QDJs+Ua37VrKybEueHuUfodebfwusGY9bas70E23Kd+o6UjTzhZmlJu9wz0AJP2KrXf36eb4QsPA0OrMgeu7KSVEfUrw18wbWY+YKqL44wMLp08+kQZECiiPT6zYfUcWsUrZJTFKbOFaYZd11vBGsvzZyy82XUxPZjLLsBL9ED0pVeKdAq0fmOHgHYLRXmBQ2fSZ7RzPzGMikIOTO1NPWXTJS1wrv7FxVO0uzW1io8ZD6QX6sy4vwYI+Sb67iR4sNrXdv7Ew2Wt+w7EQgrm5BRpahu7NT/q8P/PXAQIDAQAB",
];