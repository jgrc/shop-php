Feature: Creating filters
  Scenario: Create a filter
    Given it is "2023-04-08T12:30:00+00:00" now
    And there are the following filter groups:
      | id                                   |
      | 10000000-0000-0000-0000-000000000001 |
    When the command "shop:filter:create 00000000-0000-0000-0000-000000000001 Dogs 10000000-0000-0000-0000-000000000001" is executed
    Then the command exit code is 0
    And the following filters should exist:
     | id                                   | name | filter_group_id                      | created_at                |
     | 00000000-0000-0000-0000-000000000001 | Dogs | 10000000-0000-0000-0000-000000000001 | 2023-04-08T12:30:00+00:00 |
