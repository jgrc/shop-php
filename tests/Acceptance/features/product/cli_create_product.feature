Feature: Creating products
  Scenario: Create a product
    Given it is "2023-04-09T10:00:00+00:00" now
    And there are the following categories:
      | id                                   |
      | 10000000-0000-0000-0000-000000000001 |
    When the command "shop:product:create 00000000-0000-0000-0000-000000000001 Dogs 10 https://www.site.com/sighthound.jpg 10000000-0000-0000-0000-000000000001" is executed
    Then the command exit code is 0
    And the following products should exist:
      | id                                   | name | price | image                               | category_id                          | created_at                |
      | 00000000-0000-0000-0000-000000000001 | Dogs | 10    | https://www.site.com/sighthound.jpg | 10000000-0000-0000-0000-000000000001 | 2023-04-09T10:00:00+00:00 |
