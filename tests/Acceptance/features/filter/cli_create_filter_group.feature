Feature: Creating filter groups
  Scenario: Create a filter group
    Given it is "2023-04-08T12:30:00+00:00" now
    When the command "shop:filter-group:create 00000000-0000-0000-0000-000000000001 Dogs" is executed
    Then the command exit code is 0
    And the following filter groups should exist:
     | id                                   | name | created_at                |
     | 00000000-0000-0000-0000-000000000001 | Dogs | 2023-04-08T12:30:00+00:00 |
