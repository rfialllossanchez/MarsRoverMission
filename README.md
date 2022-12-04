<p align="center">
  <img src="http://www.intrepidmuseum.org/The-Intrepid-Experience/Past-Exhibitions/Mission-to-Mars-(Mars-Rover-exhibit)/images/mars_banner.aspx?width=676&height=268"/>
</p>

<h1 align="center">
  Mars Rover Mission, Hexagonal Architecture & CQRS with Symfony
</h1>

## Environment Setup

### Required tools
1. [Install Docker](https://www.docker.com/get-started)
2. [install Docker Compose](https://docs.docker.com/compose/install/)
3. Clone the project: `git@github.com:rogerfiallos/MarsRoverMission.git`

### Start up application 

1. Move to root project folder: `cd MarsRoverMission`
2. To build fresh docker images run: `docker-compose build --pull --no-cache`
3. To start docker containers run: `docker-compose up -d`
5. To stop docker containers run: `docker-compose down --remove-orphans`

## Project Details

Simple console application built with Symfony 6 and PHP 8. Following hexagonal architecture and CQRS pattern.

The purpose is to send commands to move rover on the martian surface.

## Structure

```scala

src
|-- Rover
|   |-- Application // Application layer holds: domain objects creators, CQRS data transformers and application services
|   |   |-- Factory
|   |   |-- Model
|   |   |   |-- Command 
|   |   |   |-- Query 
|   |   |   |-- Response 
|   |   |-- Service
|   |-- Domain // Domain layer holds: domain entities, value objects, etc
|   |   |-- Collection 
|   |   |-- Exception 
|   |   |-- ValueObject
|   |   |-- Obstacle.php
|   |   |-- Planet.php 
|   |   |-- Position.php  
|   |   |-- Rover.php  
|   `-- Infrastructure // Infrastructure layer: entry point to external interactions
|       |-- Console
|       |   |-- EstablishConnectionCommand.php
|       `-- Controller
|           `-- GetPlanetDetailsController.php
|           `-- GetRoverPositionController.php
|           `-- SetRoverInitialPositionController.php
|           `-- SendRoverCommandsController.php
|
|-- Shared // Non-bussiness logic
|   |-- Domain
|   |   |-- Bus 
|   `-- Infrastructure
|       `-- Bus
|       `-- Controller
|

tests
|-- Integration
|   |-- Infrastructure
|-- unit
|   `-- Application
|   `-- Domain
```

### How to use
1) Execute console app: 
<pre>$ docker-compose exec mars_rover php ./bin/console app:establish-connection</pre>
2) Set rover initial position:
<pre>
_  _ ____ ____ ____    ____ ____ _  _ ____ ____    _  _ _ ____ ____ _ ____ _  _
|\/| |__| |__/ [__     |__/ |  | |  | |___ |__/    |\/| | [__  [__  | |  | |\ |
|  | |  | |  \ ___]    |  \ |__|  \/  |___ |  \    |  | | ___] ___] | |__| | \|
_  _ ____ ____ ____    ____ ____ _  _ ____ ____    _  _ _ ____ ____ _ ____ _  _
Initializing...
Connection established successfully!
Planet information:
Planet Mars size 200x200 has obstacles in positions: (77,72)
Set Rover initial position
</pre>
3) Select an option:
<pre>
Available options: 
- Press 1 to check planet details
- Press 2 to check Rover position
- Press 3 to send commands to Rover
- Press 4 to finish connection
</pre>

### Execute tests
1) Unit tests: 
<pre>$ docker-compose exec mars_rover composer tests-unit</pre>
2) Integration tests:
<pre>$ docker-compose exec mars_rover composer tests-integration</pre>

