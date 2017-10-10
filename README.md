[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/MicrosoftAcademicSearch/functions?utm_source=RapidAPIGitHub_MicrosoftAcademicSearchFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# MicrosoftAcademicSearch Package
Discover more of what you need more quickly. Semantic search provides you with   highly relevant search results from continually refreshed and extensive academic content from over 120 million publications.
* Domain: [academic.research](http://academic.research.microsoft.com/)
* Credentials: key

## How to get credentials: 
1. Subscribe to the Microsoft Text Analytics API on the [Microsoft Azure portal](https://azure.microsoft.com/en-us/services/cognitive-services/AcademicSearch/).
2. Click create button.
3. In settings->credential section you will see apiKey (Ocp-Apim-Subscription-Key)

## Custom datatypes: 
   |Datatype|Description|Example
   |--------|-----------|----------
   |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
   |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
   |List|Simple array|```["123", "sample"]``` 
   |Select|String with predefined values|```sample```
   |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ``` 
 
## MicrosoftAcademicSearch.getInterpretation
Takes an end user query string (i.e., a query entered by a user of your application) and returns formatted interpretations of user intent based on the Academic Graph data and the Academic Grammar.To provide an interactive experience, you can call this method repeatedly after each character entered by the user. In that case, you should set the complete parameter to 1 to enable auto-complete suggestions. If your application does not want auto-completion, you should set the complete parameter to 0.

| Field   | Type       | Description
|---------|------------|----------
| key     | credentials| Subscription key which provides access to this API. 
| region  | String     | The region that most closely describes your location.Example: westcentralus
| complete| Select     | true means that auto-completion suggestions are generated based on the grammar and graph data.
| count   | Number     | Maximum number of interpretations to return.
| offset  | Number     | Index of the first interpretation to return. For example, count=2&offset=0 returns interpretations 0 and 1. count=2&offset=2 returns interpretations 2 and 3.
| timeout | Number     | Timeout in milliseconds. Only interpretations found before the timeout has elapsed are returned.
| query   | String     | Query entered by user. If complete is set to 1, query will be interpreted as a prefix for generating query auto-completion suggestions.
| model   | String     | Name of the model that you wish to query. Currently, the value defaults to "latest".

## MicrosoftAcademicSearch.getAcademicEntities
Return a set of academic entities based on a query expression.

| Field     | Type       | Description
|-----------|------------|----------
| key       | credentials| Subscription key which provides access to this API. 
| region    | String     | The region that most closely describes your location.Example: westcentralus
| expr      | String     | A query expression that specifies which entities should be returned.
| model     | String     | Name of the model that you wish to query. Currently, the value defaults to "latest".
| count     | Number     | Number of results to return.
| offset    | Number     | Index of the first result to return.
| orderby   | String     | Name of an attribute that is used for sorting the entities. Optionally, ascending/descending can be specified. The format is: name:asc or name:desc.
| attributes| List       | List that specifies the attribute values that are included in the response. Attribute names are case-sensitive.

## MicrosoftAcademicSearch.calcHistogram
Calculate the distribution of attribute values for a set of paper entities.

| Field     | Type       | Description
|-----------|------------|----------
| key       | credentials| Subscription key which provides access to this API. 
| region    | String     | The region that most closely describes your location.Example: westcentralus
| expr      | String     | A query expression that specifies the entities over which to calculate histograms.
| model     | String     | Name of the model that you wish to query. Currently, the value defaults to "latest".
| attributes| List       | List that specifies the attribute values that are included in the response. Attribute names are case-sensitive.
| count     | Number     | Number of results to return.
| offset    | Number     | Index of the first result to return.

## MicrosoftAcademicSearch.graphSearch
The graph query interface powered by Graph Engine allows us to not only query entities that meet certain criteria (e.g. find a paper with a given title), but also perform pattern matching via graph exploration (e.g. detect co-authorship).

| Field | Type       | Description
|-------|------------|----------
| key   | credentials| Subscription key which provides access to this API. 
| region| String     | The region that most closely describes your location.Example: westcentralus
| mode  | Select     | Request type of query. Should be "json" or "lambda"
| body  | JSON       | Query object

## MicrosoftAcademicSearch.calculateSimilarity
Calculate a floating point value based on 2 text inputs. 

| Field | Type       | Description
|-------|------------|----------
| key   | credentials| Subscription key which provides access to this API. 
| region| String     | The region that most closely describes your location.Example: westcentralus
| s1    | String     | String to be compared, input length is bounded by the limitation of the length of URL. 
| s2    | String     | String to be compared, input length is bounded by the limitation of the length of URL.

