Feature: Creating categories
  Scenario: Create a category
    Given it is "2023-04-08T12:30:00+00:00" now
    When the command "shop:category:create 00000000-0000-0000-0000-000000000001 Dogs" is executed
    Then the command finished with exit code 0
    And the following categories should exist:
     | id                                   | name | created_at                |
     | 00000000-0000-0000-0000-000000000001 | Dogs | 2023-04-08T12:30:00+00:00 |
