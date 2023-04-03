@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
    <h3>Template Coding</h3>
    <button class="btn btn-sm copycode" style="background-color: #ffa133" onclick="copyCode()">Copy Code</button>
</div>
<p id="codinganarduino"> #include &lt;BLEDevice.h&gt; <br>
    #include &lt;BLEUtils.h&gt; <br>
    #include &lt;BLEServer.h&gt; <br>
    <br>
    #define SERVICE_UUID &emsp;&emsp;&emsp;&emsp; "{{ $uuid }}" <br>
    #define CHARACTERISTIC_UUID &ensp;"beb5483e-36e1-4688-b7f5-ea07361b26a8" <br>
    #define LED 2 <br>
    <br>
    void setup() { <br>
        &emsp;Serial.begin(115200); <br>
        &emsp;Serial.println("Starting BLE work!"); <br>
      
        &emsp;BLEDevice::init("{{ $nama }}"); <br>
        &emsp;BLEServerpServer = BLEDevice::createServer(); <br>
        &emsp;BLEService pService = pServer->createService(SERVICE_UUID); <br>
        &emsp;BLECharacteristicpCharacteristic = pService->createCharacteristic(<br>
        &emsp;CHARACTERISTIC_UUID,<br>
        &emsp;BLECharacteristic::PROPERTY_READ | <br>
        &emsp;BLECharacteristic::PROPERTY_WRITE <br>
        &emsp;);<br>
        <br>
        &emsp;pCharacteristic->setValue("Hello World says Neil");<br>
        &emsp;pService->start();<br>
        &emsp;BLEAdvertisingpAdvertising = BLEDevice::getAdvertising();<br>
        &emsp;pAdvertising->addServiceUUID(SERVICE_UUID);<br>
        &emsp;pAdvertising->setScanResponse(true);<br>
        &emsp;pAdvertising->setMinPreferred(0x06); <br>
        &emsp;pAdvertising->setMinPreferred(0x12);<br>
        &emsp;BLEDevice::startAdvertising();<br>
        &emsp;Serial.println("Characteristic defined! Now you can read it in your phone!");<br>
        &emsp;pinMode(LED,OUTPUT);<br>
      } <br>
      <br>
      void loop() {<br>
        // put your main code here, to run repeatedly: <br>
        delay(1000);<br>
        digitalWrite(LED,HIGH);<br>
        delay(1000);<br>
        digitalWrite(LED,LOW);<br>
      } <br>

</p>
@endsection

@section('included-js')
    <script>
        // function copyCode(){
        //     var copyText = document.getElementsByClassName("codinganarduino")[0];
        //     copyText.select();

        //     navigator.clipboard.execCommand("copy");
        //     // try{
        //     //     await navigator.clipboard.writeText(copyText);
        //     // } catch(err) {
        //     //     console.log("Gagal copy : ", err);
        //     // }
        // }
    </script>
@endsection