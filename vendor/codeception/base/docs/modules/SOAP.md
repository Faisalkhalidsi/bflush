# SOAP


Module for testing SOAP WSDL web services.
Send requests and check if response matches the pattern.

This module can be used either with frameworks or PHPBrowser.
It tries to guess the framework is is attached to.
If a endpoint is a full url then it uses PHPBrowser.

### Using Inside Framework

Please note, that PHP SoapServer::handle method sends additional headers.
This may trigger warning: "Cannot modify header information"
If you use PHP SoapServer with framework, try to block call to this method in testing environment.

## Status

* Maintainer: **davert**
* Stability: **stable**
* Contact: codecept@davert.mail.ua

## Configuration

* endpoint *required* - soap wsdl endpoint
* SOAPAction - replace SOAPAction HTTP header (Set to '' to SOAP 1.2)

## Public Properties

* xmlRequest - last SOAP request (DOMDocument)
* xmlResponse - last SOAP response (DOMDocument)


## Actions

### dontSeeSoapResponseContainsStructure
 
Opposite to `seeSoapResponseContainsStructure`
 * `param` $xml


### dontSeeSoapResponseContainsXPath
 
Checks XML response doesn't contain XPath locator

``` php
<?php
$I->dontSeeSoapResponseContainsXPath('//root/user[@id=1]');
?>
```

 * `param` $xpath


### dontSeeSoapResponseEquals
 
Checks XML response equals provided XML.
Comparison is done by canonicalizing both xml`s.

Parameter can be passed either as XmlBuilder, DOMDocument, DOMNode, XML string, or array (if no attributes).

 * `param` $xml


### dontSeeSoapResponseIncludes
 
Checks XML response does not include provided XML.
Comparison is done by canonicalizing both xml`s.
Parameter can be passed either as XmlBuilder, DOMDocument, DOMNode, XML string, or array (if no attributes).

 * `param` $xml


### grabAttributeFrom
 
Finds and returns attribute of element.
Element is matched by either CSS or XPath

 * `Available since` 1.1
 * `param` $cssOrXPath
 * `param` $attribute
 * `return` string


### grabTextContentFrom
 
Finds and returns text contents of element.
Element is matched by either CSS or XPath

 * `Available since` 1.1
 * `param` $cssOrXPath
 * `return` string


### haveSoapHeader
 
Prepare SOAP header.
Receives header name and parameters as array.

Example:

``` php
<?php
$I->haveSoapHeader('AuthHeader', array('username' => 'davert', 'password' => '123345'));
```

Will produce header:

```
   <soapenv:Header>
     <SessionHeader>
     <AuthHeader>
         <username>davert</username>
         <password>12345</password>
     </AuthHeader>
  </soapenv:Header>
```

 * `param` $header
 * `param array` $params


### seeResponseCodeIs
 
@deprecated use seeSoapResponseCodeIs instead


### seeSoapResponseCodeIs
 
Checks response code from server.

 * `param` $code


### seeSoapResponseContainsStructure
 
Checks XML response contains provided structure.
Response elements will be compared with XML provided.
Only nodeNames are checked to see elements match.

Example:

``` php
<?php

$I->seeSoapResponseContainsStructure("<query><name></name></query>");
?>
```

Use this method to check XML of valid structure is returned.
This method does not use schema for validation.
This method does not require path from root to match the structure.

 * `param` $xml


### seeSoapResponseContainsXPath
 
Checks XML response with XPath locator

``` php
<?php
$I->seeSoapResponseContainsXPath('//root/user[@id=1]');
?>
```

 * `param` $xpath


### seeSoapResponseEquals
 
Checks XML response equals provided XML.
Comparison is done by canonicalizing both xml`s.

Parameters can be passed either as DOMDocument, DOMNode, XML string, or array (if no attributes).

Example:

``` php
<?php
$I->seeSoapResponseEquals("<?xml version="1.0" encoding="UTF-8"?><SOAP-ENV:Envelope><SOAP-ENV:Body><result>1</result></SOAP-ENV:Envelope>");

$dom = new \DOMDocument();
$dom->load($file);
$I->seeSoapRequestIncludes($dom);

```

 * `param` $xml


### seeSoapResponseIncludes
 
Checks XML response includes provided XML.
Comparison is done by canonicalizing both xml`s.
Parameter can be passed either as XmlBuilder, DOMDocument, DOMNode, XML string, or array (if no attributes).

Example:

``` php
<?php
$I->seeSoapResponseIncludes("<result>1</result>");
$I->seeSoapRequestIncludes(\Codeception\Utils\Soap::response()->result->val(1));

$dom = new \DDOMDocument();
$dom->load('template.xml');
$I->seeSoapRequestIncludes($dom);
?>
```

 * `param` $xml


### sendSoapRequest
 
Submits request to endpoint.

Requires of api function name and parameters.
Parameters can be passed either as DOMDocument, DOMNode, XML string, or array (if no attributes).

You are allowed to execute as much requests as you need inside test.

Example:

``` php
$I->sendSoapRequest('UpdateUser', '<user><id>1</id><name>notdavert</name></user>');
$I->sendSoapRequest('UpdateUser', \Codeception\Utils\Soap::request()->user
  ->id->val(1)->parent()
  ->name->val('notdavert');
```

 * `param` $request
 * `param` $body

<p>&nbsp;</p><div class="alert alert-warning">Module reference is taken from the source code. <a href="https://github.com/Codeception/Codeception/tree/2.4/src/Codeception/Module/SOAP.php">Help us to improve documentation. Edit module reference</a></div>
