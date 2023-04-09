Feature: Getting products by id
  Scenario: Get a product by id
    Given it is "2023-04-09T12:00:00+00:00" now
    And there are the following categories:
      | id                                   |
      | 10000000-0000-0000-0000-000000000001 |
    And there are the following products:
     | id                                   | name | price | category_id                          |
     | 00000000-0000-0000-0000-000000000001 | Dogs | 10    | 10000000-0000-0000-0000-000000000001 |
    And the command "shop:product:project 00000000-0000-0000-0000-000000000001" is executed
    When the "GET" request is sent to "/products/00000000-0000-0000-0000-000000000001"
    Then the response status is 200
    And the response content is:
    """
    {"id":"00000000-0000-0000-0000-000000000001","name":"Dogs","price":10}
    """
