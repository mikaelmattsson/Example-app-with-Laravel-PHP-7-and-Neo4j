
# Enable neo4j external access
sudo sed -i -e 's/#org.neo4j.server.webserver.address=0.0.0.0/org.neo4j.server.webserver.address=0.0.0.0/' /etc/neo4j/neo4j-server.properties
sudo service neo4j-service restart

echo "LC_CTYPE=\"en_US.UTF-8\"" | sudo tee -a  /etc/default/locale > /dev/null
echo "LC_ALL=\"en_US.UTF-8\"" | sudo tee -a  /etc/default/locale > /dev/null

