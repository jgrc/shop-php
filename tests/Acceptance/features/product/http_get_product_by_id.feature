Feature: Getting products by id
  Scenario: Get a product by id
    Given there are the following filter groups:
      | id                                   | name  |
      | 00000000-0000-0000-0000-000000000001 | Color |
      | 00000000-0000-0000-0000-000000000002 | Race  |
    And there are the following filters:
      | id                                   | filter_group_id                      | name    |
      | 10000000-0000-0000-0000-000000000001 | 00000000-0000-0000-0000-000000000001 | White   |
      | 10000000-0000-0000-0000-000000000002 | 00000000-0000-0000-0000-000000000001 | Black   |
      | 10000000-0000-0000-0000-000000000003 | 00000000-0000-0000-0000-000000000002 | Terrier |
    And there are the following categories:
      | id                                   | name |
      | 20000000-0000-0000-0000-000000000001 | Dogs |
    And there are the following products:
      | id                                   | name  | price | image                            | category_id                          | created_at                |
      | 30000000-0000-0000-0000-000000000001 | Rambo | 10    | https://www.site.com/terrier.jpg | 20000000-0000-0000-0000-000000000001 | 2023-04-09T12:00:00+00:00 |
    And there are products with the following filters:
      | product_id                           | filter_ids |
      | 30000000-0000-0000-0000-000000000001 | 10000000-0000-0000-0000-000000000001, 10000000-0000-0000-0000-000000000002, 10000000-0000-0000-0000-000000000003 |
    And the command "shop:product:project 30000000-0000-0000-0000-000000000001" is executed
    When the "GET" request is sent to "/products/30000000-0000-0000-0000-000000000001"
    Then the response status is 200
    And the response content is:
    """
    {
      "data": {
        "type": "product",
        "id": "30000000-0000-0000-0000-000000000001",
        "attributes": {
          "name": "Rambo",
          "price": 10,
          "image": "https://www.site.com/terrier.jpg",
          "enabled": true,
          "created_at": "2023-04-09T12:00:00+00:00",
          "category": {
            "id": "20000000-0000-0000-0000-000000000001",
            "name": "Dogs"
          },
          "filter_groups": [
            {
              "id": "00000000-0000-0000-0000-000000000001",
              "name": "Color",
              "filters": [
                {
                  "id": "10000000-0000-0000-0000-000000000001",
                  "name": "White"
                },
                {
                  "id": "10000000-0000-0000-0000-000000000002",
                  "name": "Black"
                }
              ]
            },
            {
              "id": "00000000-0000-0000-0000-000000000002",
              "name": "Race",
              "filters": [
                {
                  "id": "10000000-0000-0000-0000-000000000003",
                  "name": "Terrier"
                }
              ]
            }
          ]
        }
      }
    }
    """

  Scenario: Product not found
    When the "GET" request is sent to "/products/00000000-0000-0000-0000-000000000001"
    Then the response status is 404
    And the response content is:
    """
    {
      "errors": [
        {
          "title": "Product \u002200000000-0000-0000-0000-000000000001\u0022 not found.",
          "code": "product-not-found"
        }
      ]
    }
    """
