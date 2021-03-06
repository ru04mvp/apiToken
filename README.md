# API 接口參數驗證說明

透過接口參數予以平面化並重組後再進行Hash取得的一組長字串，將這組長字串以增加參數的形式附加在原始參數中，藉此雙方可在收發內容時予以驗證參數正確性。


## 原始參數

假設我們有一組參數內容準備傳遞

    $Array = [
      "id"=> 1,
      "data"=> [
        "par01"=> 1,
        "par02"=> 2,
        "par03"=> 3,
      ]
    ]

## 呼叫參數驗證

我們只需要將原本的參數陣列與 Token 傳入方法中， 由接口提供方給予一組字串作為Token

    $CheckCode = Apitoken->generate( Array , _TOKEN_ )

## 附加參數

我們只需要透過附加 $CheckCode 參數並傳遞即可完成操作 

    $Array = [
      "id"=> 1,
      "data"=> [
        "par01"=> 1,
        "par02"=> 2,
        "par03"=> 3,
      ],
      "CheckMacValue"=> $CheckCode
    ]

## 重新驗證

同理，接收方只需要將參數中的 CheckMacValue 欄位移除並重新操作產生驗證碼，再予以比對是否相符即可。
