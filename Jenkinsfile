pipeline {
    agent any

    stages {
        stage ('Compile Stage') {

            steps {
                echo 'Compile Stage'

            }
        }

        stage ('Testing Stage') {

            steps {
                echo 'Testing Stage'
            }
        }

        stage ('Deployment Stage') {
            steps {
                echo 'Deployment Stage'
            }
        }
        stage ('Notify'){
            steps {
                stdout = bat(returnStdout: true, script: "curl -X POST -H 'Authorization: Bearer ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk' -F 'message=helloworld' https://notify-api.line.me/api/notify")
                println("stdout ################ " + stdout + " ####################")
            }
        }
    }
}