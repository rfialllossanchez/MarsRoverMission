<p align="center">
  <a href="http://www.intrepidmuseum.org/The-Intrepid-Experience/Past-Exhibitions/Mission-to-Mars-(Mars-Rover-exhibit)/images/mars_banner.aspx?width=676&height=268">
    <img src="http://www.intrepidmuseum.org/The-Intrepid-Experience/Past-Exhibitions/Mission-to-Mars-(Mars-Rover-exhibit)/images/mars_banner.aspx?width=676&height=268"/>
  </a>
</p>

<h1 align="center">
  Mars Rover Mission with PHP 8.1 and Symfony 6
</h1>

## Environment Setup

### Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git@github.com:rogerfiallos/MarsRoverMission.git`
3. Move to the project folder: `cd MarsRoverMission`

### Application execution

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up -d`
3. Run `docker-compose exec mars_rover php ./bin/console app:establish-connection` (the logs will be displayed in the current shell)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Project explanation

Simple console application to send commands to Mars rover.

### Structure

```scala
$ tree -L 4 src

src
|-- Rover // Features related to bussiness
|   |-- Application // The application layer
|   |   |-- Factory // Domain objects instantation
|   |   |-- Model // Data transformer objects 
|   |   |   |-- Command 
|   |   |   |-- Query 
|   |   |   |-- Response 
|   |   |-- Service (Applications services) 
|   |-- Domain // The domain layer
|   |   |-- Collection 
|   |   |-- Exception 
|   |   |-- ValueObject
|   |   |-- Obstacle.php
|   |   |-- Planet.php 
|   |   |-- Position.php  
|   |   |-- Rover.php  
|   `-- Infrastructure // The infrastructure layer
|       |-- Console
|       |   |-- EstablishConnectionCommand.php
|       `-- Controller
|           `-- GetRoverPositionController.php
|           `-- SendRoverCommandsController.php
|
|-- Shared
|   |-- Domain
|   |   |-- Bus 
|   `-- Infrastructure
|       `-- Bus
|       `-- Controller
```

### How to use
1) Execute console app: <pre>$ docker-compose exec mars_rover php ./bin/console app:establish-connection</pre>
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
