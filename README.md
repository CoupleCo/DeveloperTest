# DeveloperTest
Startup Journal case for potential candidates

## Introduction
This repository is our ongoing testing ground for potential new developers that want to demonstrate their skills in a "real" Laravel application

## Status
Currently there almost no code written yet - the first pull-requst have yet to be approved

## Near term backlog
We suggest the first candiate start by executing the following parts of the backlog:
- Create a basic login page using the design.nomorecph.com design settings
- Ability to create a team
- Ability to send invite
- Ability to accept invite

Remember: Do it TDD - write the tests first ;)

# Background

## Purpose
We want to assess the candidate with respect to:
-	Ability to learn something new
-	Demonstrate ability to write well structured, easy to read code
-	Test work speed and ability to execute across the stack

We want candidates to use a clone of our internal stack:
-	Laravel 5.7+
-	Vue.js 
-	Pusher (free version - not required in)

Specific areas we want to test:
-	Basic Laravel MVC understanding
-	Basic Vue / axios / json communication with the back-end
-	Writing tests (TDD)
-	Setting up and migrating the database
-	Basic storage interactions
-	Use of Laravel's authentication
- Use of middleware 

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

