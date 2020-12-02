# DeveloperTest
Startup Journal case for potential candidates

## Introduction
This repository is our ongoing testing ground for potential new developers that want to demonstrate their skills in a "real" Laravel application

## Near term backlog
We suggest the first candiate start by executing the following parts of the backlog:
- Create a basic login page using the design.nomorecph.com design settings
- Ability to create a team
- Ability to send invite
- Ability to accept invite

Remember: Do it TDD - write the tests first ;)

# Background

## What to build: “Startup Journal” 😊
-	Basic idea: A web platform in which employees of innovative startup companies can login and share pictures from the startup journey. 
-	You have to build the simple MVP of the product in order to test the idea with your partners

## Features to be built / backlog:
- Register / Login / authentication
- Ability to create a team
- Ability to send an email invitation to a potential member
- Ability post new pictures 
- Ability to comment on pictures
- Ability to add emojis to pictures 
- Show statistics of on weekly basis:
  - Number of active users
  - The most active user
  - Number of images posted
  - Most popular image 
- Ability to upload a profile picture
- Ability to flag pictures as being inappropriate 
- Make the overview update in real time using Pusher

## Business contraints to consider:
- Users can only be part of one team
- Users that are team owners cannot join other teams
- Only .jpeg image files of less than 500 kb are accepted
- Comments cannot be longer than 256 characters  
- The front-end most be build as a SPA (single page app)
- Users cannot post the same comment to the same picture more than once
- For the front-end the design style of design.nomorecph.com must be used
- Tailwind must be used for all front-end

# Task

## What I did

- Here I have worked on the "Near term backlog" taking into consideration the business constraints. I have adopted the TDD approach in the development of the backend. 
- I built the front-end with Vue.js as a SPA communicating with the backend through RESTful API endpoints. API Documentation available [here](https://documenter.getpostman.com/view/2211912/TVmLCJiY)
- The front-end also makes use of the design style guide with Tailwind CSS.
View a brief recording of the end product [here](https://www.loom.com/share/2322773e626248cda4414a75f8222a3a)

## Features

- Guests can register, login and logout.
	- It is assumed that a user can register without creating/joining a team.
- Users can create a team.
	- Team owners/members cannot create a new team.
- Users can see all teams.
- Users can view a team.
- Users can see members on a team.
- Users can invite other users to join a team.
	- Invitation can only be sent to registered users.
	- Invitation cannot be sent to team owners/members.
- Users can accept an invitation to join a team.

- Some design decisions:
	- I used Laravel's Passport to implement a "Bearer Token" authentication. When a user logs in, they receive a token which is required in the header for requests to the endpoints.
	- I adopted most of Uncle Bob's clean code principles in the refactoring of the InviteController and InviteRepository classes.
	- I have adopted the use of a Repository in order to have lean controllers. This can be seen in the implementation of the "Invite" feature.

## If I had more time 

- I would implement more features in the backlog to have a richer MVP.
- I would write more tests for edge cases and increase the test coverage.
- I would adopt a more robust Repository pattern in a way that implementation would be based on interfaces.
- I would implement authorization to take care of some business constraints and user permissions.
- I would implement better feedback mechanism and error handling for the SPA.



