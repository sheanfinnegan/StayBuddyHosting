Feature: View Transaction History

  As a registered user
  I want to view my transaction history
  So that I can track my past payments and bookings

  Scenario: User views their own transaction history
    Given I am logged in as a user
    And I have a transaction history with homestay and payment data
    When I visit the history page
    Then I should see the name of the homestay
    And I should see the payment amount

  Scenario: User cannot see another user's transaction
    Given another user has a transaction
    And I am logged in as a different user
    When I visit the history page
    Then I should not see the other user's homestay name
    And I should not see their payment amount
