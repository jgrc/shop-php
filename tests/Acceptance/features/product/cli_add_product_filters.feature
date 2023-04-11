Feature: Creating products
  Scenario: Create a product
    Given there are the following filter groups:
      | id                                   |
      | 00000000-0000-0000-0000-000000000001 |
    And there are the following filters:
      | id                                   | filter_group_id                      |
      | 10000000-0000-0000-0000-000000000001 | 00000000-0000-0000-0000-000000000001 |
      | 10000000-0000-0000-0000-000000000002 | 00000000-0000-0000-0000-000000000001 |
    And there are the following categories:
      | id                                   |
      | 20000000-0000-0000-0000-000000000001 |
    And there are the following products:
      | id                                   | category_id                          |
      | 30000000-0000-0000-0000-000000000001 | 20000000-0000-0000-0000-000000000001 |
    When the command "shop:product:add-filters 30000000-0000-0000-0000-000000000001 10000000-0000-0000-0000-000000000001 10000000-0000-0000-0000-000000000002" is executed
    Then the command exit code is 0
    And the following products should exist:
      | id                                   | filter_ids                                                                 |
      | 30000000-0000-0000-0000-000000000001 | 10000000-0000-0000-0000-000000000001, 10000000-0000-0000-0000-000000000002 |
