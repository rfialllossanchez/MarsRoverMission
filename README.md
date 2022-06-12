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
3. Run `docker-compose up` (the logs will be displayed in the current shell)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Project explanation

Simple console application to send commands to Mars rover.

