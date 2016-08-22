Feature:
  In order to ensure that authorization works as expected

#INCORRECT TOKEN
Scenario:
  Given I request getAuthorized with incorrect token "?token=token&u=username&p=password"
  Then I should get a response
  And the response status should be "400"
  And the response should contain a "error" field with "The token is not correct"
