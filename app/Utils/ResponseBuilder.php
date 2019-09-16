<?php

namespace App\Utils;

class ResponseBuilder
{

  /**
   * Type of the response (error or success)
   *
   * @var string|null
   */
  private $type = null;

  /**
   * Additional text for response
   *
   * @var string|null
   */
  private $text = null;

  /**
   * Payload for response
   *
   * @var array|null
   */
  private $data = null;

  /**
   * Setting type of response as error
   *
   * @return ResponseBuilder
   */
  public function error()
  {
    $this->type = 'error';
    return $this;
  }

  /**
   * Setting type of response as success
   *
   * @return ResponseBuilder
   */
  public function ok()
  {
    $this->type = 'success';
    return $this;
  }

  /**
   * Setting text of response
   *
   * @param string $value - Text of response
   *
   * @return ResponseBuilder
   */
  public function setText($value)
  {
    $this->text = $value;
    return $this;
  }

  /**
   * Setting payload for response
   *
   * @param array $value - Payload of response
   *
   * @return ResponseBuilder
   */
  public function setData($value)
  {
    $this->data = $value;
    return $this;
  }

  /**
   * Building response
   *
   * @return array
   */
  public function build()
  {
    $Response = ['type' => $this->type];

    if ($this->text != null) {
      $Response['text'] = $this->text;
    }

    if ($this->data != null) {
      $Response['data'] = $this->data;
    }

    return $Response;
  }
}
